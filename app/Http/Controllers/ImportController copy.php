<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Aws\S3\S3Client;

class ImportController extends Controller
{
    function import()
    {
        $packages = Package::all();
        return view('admin.contents.import', compact('packages'));
    }

    function storeImport(Request $request)
    {
        // Validasi input
        $request->validate([
            'api_key' => 'required|string',
            'api_secret' => 'required|string',
            'bucket' => 'required|string',
            'region' => 'required|string',
            'folder' => 'nullable|string',
            'package_id' => 'required|exists:packages,id',
            'is_premium' => 'nullable|boolean',
            'number_of_trials' => ['sometimes', 'required_if:is_premium,1', 'integer', 'min:0'], // Hanya wajib jika premium
        ]);

        $number_of_trials = (int) $request->input('number_of_trials');
        $counter = 0; // Untuk menghitung jumlah file yang telah diproses

        // Konfigurasi koneksi ke DigitalOcean Spaces
        $bucketName = $request->input('bucket'); // Ganti dengan nama bucket Anda
        $region = $request->input('region'); // Ganti dengan region Anda
        $endpointRegion = "https://{$region}.digitaloceanspaces.com";
        $endpoint = "https://{$bucketName}.{$region}.digitaloceanspaces.com";

        // Inisialisasi S3 Client
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => $region,
            'endpoint' => $endpointRegion,
            'credentials' => [
                'key'    => $request->input('api_key'),
                'secret' => $request->input('api_secret'),
            ],
        ]);

        // Ambil daftar file dari folder tertentu
        $folder = $request->input('folder', '');
        $objects = $s3Client->listObjectsV2([
            'Bucket' => $bucketName,
            'Prefix' => $folder, // Filter berdasarkan folder
        ]);

        // Inisialisasi FFMpeg
        // $ffmpeg = FFMpeg::create([
        //     'ffmpeg.binaries'  => '/usr/bin/ffmpeg', // Sesuaikan dengan path FFmpeg di server Anda
        //     'ffprobe.binaries' => '/usr/bin/ffprobe', // Sesuaikan dengan path FFprobe di server Anda
        // ]);
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe', // Sesuaikan dengan path FFmpeg di server Anda
            'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe', // Sesuaikan dengan path FFprobe di server Anda
        ]);

        // Proses setiap file
        foreach ($objects['Contents'] as $object) {
            $filePath = $object['Key'];
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $contentType = in_array($extension, ['mp4', 'avi', 'mov']) ? 'video' : 'image';

            // Generate URL lengkap untuk source
            $sourceUrl = "{$endpoint}/{$filePath}";

            // Jika file adalah gambar, gunakan source yang sama untuk thumbnail
            $thumbnailUrl = null;
            if ($contentType === 'image') {
                $thumbnailUrl = $sourceUrl; // Gunakan source sebagai thumbnail
            } elseif ($contentType === 'video') {
                // Jika file adalah video, ekstrak thumbnail
                $tempVideoPath = tempnam(sys_get_temp_dir(), 'video') . '.' . $extension;
                $s3Client->getObject([
                    'Bucket' => $bucketName,
                    'Key'    => $filePath,
                    'SaveAs' => $tempVideoPath,
                ]);

                // Ekstrak frame dari video (misalnya, frame pada detik ke-5)
                $thumbnailTempPath = tempnam(sys_get_temp_dir(), 'thumbnail') . '.jpg';
                $video = $ffmpeg->open($tempVideoPath);
                $video
                    ->frame(TimeCode::fromSeconds(5)) // Ambil frame pada detik ke-5
                    ->save($thumbnailTempPath);

                // Upload thumbnail ke DigitalOcean Spaces
                $thumbnailPath = 'thumbnails/' . pathinfo($filePath, PATHINFO_FILENAME) . '.jpg';
                $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key'    => $thumbnailPath,
                    'Body'   => file_get_contents($thumbnailTempPath),
                    'ACL'    => 'public-read', // Sesuaikan dengan kebijakan akses Anda
                ]);

                // Generate URL lengkap untuk thumbnail
                $thumbnailUrl = "{$endpoint}/{$thumbnailPath}";

                // Hapus file temporary
                unlink($tempVideoPath);
                unlink($thumbnailTempPath);
            }

            // Tentukan apakah konten premium atau tidak berdasarkan jumlah trials
            $isPremium = $counter < $number_of_trials ? false : $request->has('is_premium');

            // Masukkan data ke dalam tabel contents
            Content::create([
                'package_id' => $request->input('package_id'),
                'title' => pathinfo($filePath, PATHINFO_FILENAME),
                'slug' => Str::slug(pathinfo($filePath, PATHINFO_FILENAME)),
                'content_type' => $contentType,
                'source_type' => 'url',
                'source' => $sourceUrl, // URL lengkap untuk source
                'thumbnail' => $thumbnailUrl, // URL lengkap untuk thumbnail
                'is_premium' => $isPremium,
            ]);
        }

        return redirect()->route('contents.index')->with('success', 'Content imported successfully!');
    }
}

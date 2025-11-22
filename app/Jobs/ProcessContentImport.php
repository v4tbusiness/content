<?php

namespace App\Jobs;

use App\Models\Content;
use Aws\S3\S3Client;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessContentImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $s3Config;
    protected $filePath;
    protected $packageId;
    protected $isPremium;
    protected $numberOfTrials;
    protected $counter;

    /**
     * Create a new job instance.
     */
    public function __construct($s3Config, $filePath, $packageId, $isPremium, $numberOfTrials, $counter)
    {
        $this->s3Config = $s3Config;
        $this->filePath = $filePath;
        $this->packageId = $packageId;
        $this->isPremium = $isPremium;
        $this->numberOfTrials = $numberOfTrials;
        $this->counter = $counter;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => $this->s3Config['region'],
            'endpoint' => $this->s3Config['endpoint_region'],
            'credentials' => [
                'key'    => $this->s3Config['api_key'],
                'secret' => $this->s3Config['api_secret'],
            ],
        ]);

        $bucketName = $this->s3Config['bucket'];
        $endpoint = $this->s3Config['endpoint'];
        $filePath = $this->filePath;

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $contentType = in_array($extension, ['mp4', 'avi', 'mov']) ? 'video' : 'image';

        // Generate URL lengkap untuk source
        $sourceUrl = "{$endpoint}/{$filePath}";

        // Jika file adalah gambar, gunakan source yang sama untuk thumbnail
        $thumbnailUrl = null;
        if ($contentType === 'image') {
            $thumbnailUrl = $sourceUrl;
        } elseif ($contentType === 'video') {
            // Ekstrak thumbnail
            $tempVideoPath = tempnam(sys_get_temp_dir(), 'video') . '.' . $extension;
            $s3Client->getObject([
                'Bucket' => $bucketName,
                'Key'    => $filePath,
                'SaveAs' => $tempVideoPath,
            ]);

            $thumbnailTempPath = tempnam(sys_get_temp_dir(), 'thumbnail') . '.jpg';

            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/bin/ffprobe',
            ]);

            $video = $ffmpeg->open($tempVideoPath);
            $video
                ->frame(TimeCode::fromSeconds(5))
                ->save($thumbnailTempPath);

            $thumbnailPath = 'thumbnails/' . pathinfo($filePath, PATHINFO_FILENAME) . '.jpg';

            $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key'    => $thumbnailPath,
                'Body'   => file_get_contents($thumbnailTempPath),
                'ACL'    => 'public-read',
            ]);

            $thumbnailUrl = "{$endpoint}/{$thumbnailPath}";

            unlink($tempVideoPath);
            unlink($thumbnailTempPath);
        }

        // Tentukan apakah konten premium atau tidak berdasarkan jumlah trials
        $isPremium = $this->counter < $this->numberOfTrials ? false : $this->isPremium;

        // Simpan ke database
        Content::create([
            'package_id' => $this->packageId,
            'title' => pathinfo($filePath, PATHINFO_FILENAME),
            'slug' => Str::slug(pathinfo($filePath, PATHINFO_FILENAME)),
            'content_type' => $contentType,
            'source_type' => 'url',
            'source' => $sourceUrl,
            'thumbnail' => $thumbnailUrl,
            'is_premium' => $isPremium,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessContentImport;
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
        $request->validate([
            'api_key' => 'required|string',
            'api_secret' => 'required|string',
            'bucket' => 'required|string',
            'region' => 'required|string',
            'folder' => 'nullable|string',
            'package_id' => 'required|exists:packages,id',
            'is_premium' => 'nullable|boolean',
            'number_of_trials' => ['sometimes', 'required_if:is_premium,1', 'integer', 'min:0'],
        ]);

        $numberOfTrials = (int) $request->input('number_of_trials');
        $counter = 0;

        $s3Config = [
            'api_key' => $request->input('api_key'),
            'api_secret' => $request->input('api_secret'),
            'bucket' => $request->input('bucket'),
            'region' => $request->input('region'),
            'endpoint_region' => "https://{$request->input('region')}.digitaloceanspaces.com",
            'endpoint' => "https://{$request->input('bucket')}.{$request->input('region')}.digitaloceanspaces.com",
        ];

        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => $s3Config['region'],
            'endpoint' => $s3Config['endpoint_region'],
            'credentials' => [
                'key'    => $s3Config['api_key'],
                'secret' => $s3Config['api_secret'],
            ],
        ]);

        $folder = $request->input('folder', '');
        $objects = $s3Client->listObjectsV2([
            'Bucket' => $s3Config['bucket'],
            'Prefix' => $folder,
        ]);

        // foreach ($objects['Contents'] as $object) {
        //     dispatch(new ProcessContentImport(
        //         $s3Config,
        //         $object['Key'],
        //         $request->input('package_id'),
        //         $request->has('is_premium'),
        //         $numberOfTrials,
        //         $counter
        //     ));
        //     $counter++;
        // }

        foreach ($objects['Contents'] as $object) {
            $filePath = $object['Key'];

            // Lewati jika objek ini adalah folder (biasanya memiliki '/' di akhir)
            if (str_ends_with($filePath, '/')) {
                continue;
            }

            dispatch(new ProcessContentImport(
                $s3Config,
                $filePath,
                $request->input('package_id'),
                $request->has('is_premium'),
                $numberOfTrials,
                $counter
            ));
            $counter++;
        }

        return redirect()->route('contents.index')->with('success', 'Content import queued successfully!');
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Video;
use App\Service\UploadVideo;
use Illuminate\Http\Request;

class UploadVideoController extends Controller
{
    public function __construct(private UploadVideo $uploadVideo)
    {
    }

    public function upload(Request $request)
    {
        $fileVideo = $request->file('video');
        $responseUpload = $this->uploadVideo->uploadMedia($fileVideo);

        if ($responseUpload != null) {
            Video::query()->create([
                "url" => $responseUpload['media'],
                "thumbnail" => $responseUpload['thumb'],
                "name" => $request->name ?? $fileVideo->getClientOriginalName(),
                "width" => $responseUpload['width'],
                "height" => $responseUpload['height']
            ]);
            return redirect()->back()->with([
                "success_message" => "sukses upload file"
            ]);
        }
        return redirect()->back()
            ->with([
                "error_message" => "file gagal diupload"
            ]);
    }
}

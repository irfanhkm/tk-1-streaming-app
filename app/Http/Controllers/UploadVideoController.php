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

    public function create(Request $request)
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

    public function update(Request $request, $id)
    {
        $fileVideo = $request->file('video');
        $updated = [
            'name' => $request->name
        ];
        if ($fileVideo) {
            $responseUpload = $this->uploadVideo->uploadMedia($fileVideo);
            if ($responseUpload != null) {
                $updated['url'] = $responseUpload['media'];
                $updated['thumbnail'] = $responseUpload['thumb'];
                $updated['width'] = $responseUpload['width'];
                $updated['height'] = $responseUpload['height'];
            }
        }

        Video::query()->where('id', $id)->update($updated);

        return redirect()->back()->with([
            "success_message" => "sukses upload file"
        ]);
    }

    public function delete(Request $request, $id)
    {
        return Video::query()->where('id', $id)->delete();
    }
}

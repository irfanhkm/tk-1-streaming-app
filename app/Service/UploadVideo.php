<?php
namespace App\Service;

use Illuminate\Support\Facades\Http;

class UploadVideo
{
    private $baseUrl = "https://thumbsnap.com/api/upload";
    private $apiKey = "00001fd493945f466e80f3f743605024";

    public function uploadMedia($media)
    {
        $contents = file_get_contents($media->getRealPath());
        $response = Http::attach(
            'media', $contents, $media->getClientOriginalName()
        )->post($this->baseUrl, [
            'key' => $this->apiKey
        ]);

        if ($response->json() !== null
            && $response->json()['data'] != null
            && $response->json()['data']['url'] != null) {
            return $response->json()['data'];
        }
        return null;
    }
}

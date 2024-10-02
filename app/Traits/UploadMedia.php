<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait UploadMedia
{
    function UploadSingleMedia($media, $title = null, $dir = 'others', $old, $disk = 'public')
    {
        if ($old) {
            Storage::disk($disk)->delete($old);
        }
        if ($media) {
            $MediaName = ($title ?? uniqid()) . '.' . $media->extension();
            $upload = $media->storeAs($dir, $MediaName, $disk);
            return $upload;
        } else {
            return false;
        }
    }
    function MulltipleUploadMedia($galleries, $slug = 'other', $dir = 'galleries') {
        $uniqName = null;
        $gallImageNameArray = [];

        // Validate if $galleries is an array or object
        if (!is_null($galleries) && (is_array($galleries) || is_object($galleries))) {
            foreach ($galleries as $gallImage) {
                $uniqName = $slug . uniqid();
                $gallImageNameArray[] = $this->UploadSingleMedia($gallImage, $uniqName, $dir, '');
            }
        }

        return $gallImageNameArray;
    }

}

<?php


namespace App\Http\Services\ImageProcessing;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageUploader
{

    function storeImage($file)
    {
        $imageName = Str::random(8) . "." . $file->extension();
        Storage::putFileAs('public', $file, $imageName);
        return $imageName;
    }


    function storeMultipleImages($files, $record, $photoType)
    {
        foreach ($files as $key => $file) {
            $imageName = Str::random(8) . "." . $file->extension();
            Storage::putFileAs('public', $file, $imageName);
            $record->photos()->create([
                'name' => $imageName,
                'photo_type' => $photoType,
            ]);
        }
        return;
    }
}

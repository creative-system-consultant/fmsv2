<?php

namespace App\Traits;

use DateTime;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageIntervention
{
    /**
     * saveOriginalFile
     *
     * @param  mixed $logo
     * @param  mixed $uuid
     * @param  mixed $folder
     * @return string
     */
    public function saveOriginalFile($logo, $uuid, $folder) : string
    {
        // original extension
        $oriExt = $logo->getClientOriginalextension();
        // save original logo
        $oriImg = Image::make($logo)->stream();
        $oriPath = 'original/' . $folder . '/' . $uuid . '.' . $oriExt;
        Storage::put('public/' . $oriPath, $oriImg);

        return $oriExt;
    }

    /**
     * createThumbnail
     *
     * @param  mixed $logo
     * @param  mixed $uuid
     * @param  mixed $folder
     * @return string
     */
    public function createThumbnail($logo, $uuid, $folder): string
    {
        // Search for existing files that start with the client UUID
        $folderPath = 'thumbnail/' . $folder . '/';
        $pattern = storage_path('app/public/' . $folderPath) . $uuid . '-*.*';
        $existingFiles = glob($pattern);

        // Delete existing files if any
        foreach ($existingFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $ext = $logo->getClientOriginalextension();
        $realPath = $logo->getRealPath();
        // save thumbnail
        $thumbImg = Image::make($realPath);
        $height = 500;
        $width = 500;
        $thumbImg->height() > $thumbImg->width() ? $width = null : $height = null;
        $thumbImg->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->stream();

        // Append current datetime with milliseconds to the filename
        $datetime = new DateTime();
        $filename = $uuid . '-' . $datetime->format('YmdHisu');
        $thumbPath = $folderPath . $filename . '.' . $ext;
        Storage::put('public/' . $thumbPath, $thumbImg);

        return $thumbPath;
    }
}
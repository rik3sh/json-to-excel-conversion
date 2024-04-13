<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUploadRequest;

class FileService
{
    /**
     * Uploads a file to the specified storage folder.
     *
     * @param FileUploadRequest $request The request object containing the file to be uploaded.
     * @return string The path to the uploaded file.
     */
    public function upload_file(FileUploadRequest $request): string
    {
        $file = $request->file('jsonfile');
        $folder = 'uploads';
        $fileName = 'u-' . Str::uuid() . '.' . $file->getClientOriginalExtension();

        $filePath = Storage::putFileAs($folder, $file, $fileName);

        return $filePath;
    }
}
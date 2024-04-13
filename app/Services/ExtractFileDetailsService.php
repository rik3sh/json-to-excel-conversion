<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ExtractFileDetailsService
{
    /**
     * Class ExtractFileDetailsService
     *
     * This class provides a method to get the files and their details from the 'uploads' directory.
     *
     * @package App\Services
     */
    public function get_files_and_details(): array
    {
        $files = Storage::files('uploads');

        foreach ($files as $file) {
            $path = Storage::path($file);
            $original = basename($file);
            $converted = str_replace(["u-", ".json"], ["c-", ".xlsx"], $original);
            $timestamp = filemtime($path);

            $uploads[] = [
                'name' => $original,
                'size' => round(Storage::size($file) / 1024 / 1024, 2) . ' MB',
                'has_converted_file' => Storage::exists('converts/' . $converted),
                'timestamp' => $timestamp,
                'date' => date('Y-m-d g:i a', $timestamp)
            ];
        }

        // Sort files by timestamp
        usort($uploads, function ($a, $b) {
            return $a['timestamp'] <=> $b['timestamp'];
        });

        return $uploads;
    }
}
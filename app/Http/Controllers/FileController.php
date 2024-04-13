<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\FileService;
use App\Jobs\ProcessJsonToExcel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUploadRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    /**
     * Display the file creation view.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Dashboard/Create');
    }

    /**
     * Store a newly uploaded file and dispatch a job to process it.
     *
     * @param FileUploadRequest $request
     * @param FileService $fileService
     * @return RedirectResponse
     */
    public function store(FileUploadRequest $request, FileService $fileService): RedirectResponse
    {
        $filePath = $fileService->upload_file($request);

        ProcessJsonToExcel::dispatch($filePath);

        return to_route('dashboard');
    }

    /**
     * Download a file if it exists.
     *
     * @param string $path The original file path
     * @return StreamedResponse 
     */
    public function download($path): StreamedResponse 
    {
        $replaced = str_replace(["u-", ".json"], ["c-", ".xlsx"], $path);
        $newPath = 'converts/' . $replaced;

        abort_if(!Storage::exists($newPath), 404);

        return Storage::download($newPath);
    }
}

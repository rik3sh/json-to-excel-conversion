<?php

namespace App\Jobs;

use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Bus\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessJsonToExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $filePath
    ) {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = json_decode(Storage::get($this->filePath), true);

        $getFileName = basename($this->filePath);

        $extractFileName = pathinfo(str_replace("u-", "c-", $getFileName), PATHINFO_FILENAME);

        $newFileName = 'converts/' . $extractFileName . '.xlsx';
        
        Excel::store(new UsersExport($data), $newFileName);
    }
}

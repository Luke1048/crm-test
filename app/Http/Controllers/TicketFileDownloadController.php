<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TicketFileDownloadController extends Controller
{
    public function __invoke(File $file): StreamedResponse
    {
        $filePath = $file->path;

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('local')->download($filePath, $file->name);
    }
}

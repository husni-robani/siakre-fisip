<?php

namespace App\Http\Controllers;

use App\Models\Document;

class DownloadsController extends Controller
{
    public function __invoke($id)
    {
        $document = Document::find($id);
        return response()->download(storage_path('app/documents/' . $document->file));
    }
}

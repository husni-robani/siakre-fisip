<?php

namespace App\Http\Controllers;

use App\Enums\StatusDocument;
use App\Models\Document;
use Auth;
use Inertia\Inertia;
use Redirect;

class VerifyController extends Controller
{
    public function index()
    {
        if (Auth::user()->major) {
            $documents = Document::query()
                ->with(['user', 'sub'])
                ->byMajorId(Auth::user()->major_id)
                ->NotVerified()
                ->get();
        } else {
            $documents = Document::query()
                ->with(['user', 'sub'])
                ->NotVerified()
                ->get();
        }

        return Inertia::render('Verify/Index', compact('documents'));
    }

    public function verifikasiDokumen(Document $document)
    {
        $document->update(['status' => StatusDocument::Terverifikasi]);

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil melakukan verifikasi dokumen.'
        ]);
    }
}

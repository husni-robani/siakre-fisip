<?php

namespace App\Http\Controllers;

use App\Enums\StatusDocument;
use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use App\Services\MajorService;
use App\Services\StandardService;
use App\Services\SubService;
use App\Traits\HasMappingSelectOption;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;

class DocumentsController extends Controller
{
    use HasMappingSelectOption;

    protected DocumentService $documentService;
    protected StandardService $standardService;
    protected MajorService $majorService;
    protected SubService $subService;

    public function __construct(DocumentService $documentService, StandardService $standardService, MajorService $majorService, SubService $subService)
    {
        $this->authorizeResource(Document::class, 'document');
        $this->documentService = $documentService;
        $this->majorService = $majorService;
        $this->standardService = $standardService;
        $this->subService = $subService;
    }

    public function index(Request $request)
    {
        $standards = $this->standardService->getStandards();

        $filters = [
            'standardId' => $request->has('standardId')
                ? $request->get('standardId')
                : $standards[0]->id,
        ];

        $documents = $this->documentService->getDocumentsByStandardId(Auth::user(), $filters['standardId']);

        return Inertia::render('Documents/Index', compact('standards', 'filters', 'documents'));
    }

    public function create(Request $request)
    {
        $majors = $this->mapToOptions($this->majorService->getMajors());
        $standards = $this->mapToOptions($this->standardService->getStandards(), true);

        $subs = collect([]);
        if ($request->has('standardId')) {
            $subs = $this->subService->getSubByStandardId($request->get('standardId'));
            $subs = $this->mapToOptions($subs, true);
        }

        $filters = [
            'standardId' => $request->has('standardId') ? $request->get('standardId') : null,
        ];

        return Inertia::render('Documents/Create', compact('majors', 'standards', 'subs', 'filters'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $this->documentService->uploadDocument(
            $request['user_id'],
            $request['sub_id'],
            $request['major_id'],
            StatusDocument::from($request['status']),
            $request['name'],
            $request['file']
        );

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil melakukan upload dokumen.',
        ]);
    }

    public function show(Document $document)
    {
    }

    public function edit(Document $document)
    {
    }

    public function update(Request $request, Document $document)
    {
    }

    public function destroy(Document $document)
    {
    }
}

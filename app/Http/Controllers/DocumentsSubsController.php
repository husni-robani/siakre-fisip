<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Major;
use App\Models\Standard;
use App\Models\Sub;
use App\Services\DocumentService;
use App\Services\SubService;
use App\Services\TimelineService;
use App\Traits\HasMappingSelectOption;
use Auth;
use Inertia\Inertia;
use Redirect;

class DocumentsSubsController extends Controller
{
    use HasMappingSelectOption;

    protected DocumentService $documentService;
    protected SubService $subService;
    protected TimelineService $timelineService;

    public function __construct(DocumentService $documentService, SubService $subService, TimelineService $timelineService)
    {
        $this->documentService = $documentService;
        $this->subService = $subService;
        $this->timelineService = $timelineService;
    }

    public function index(Standard $standard)
    {
        if (Auth::user()->major) {
            $subs = Sub::query()
                ->with('documents')
                ->byStandard($standard->id)
                ->byMajor(Auth::user()->major_id)
                ->hasDocument()
                ->get();

            $majors = [];
            $filters = [];
        } else {
            $majors = $this->mapToOptions(Major::all());

            $filters = [
                'majorId' => request()->input('majorId')
                    ? request()->input('majorId')
                    : $majors->first()['id'],
            ];

            $subs = Sub::query()
                ->with('documents')
                ->byStandard($standard->id)
                ->byMajor($filters['majorId'])
                ->hasDocument()
                ->get();
        }

        return Inertia::render('Documents/Subs/Index', compact('standard', 'subs', 'majors', 'filters'));
    }

    public function show(Standard $standard, Sub $sub)
    {
        if (Auth::user()->major) {
            $documents = Document::with(['user'])
                ->byMajorId(Auth::user()->major_id)
                ->byStandardId($standard->id)
                ->bySubId($sub->id)
                ->Verified()
                ->latest()
                ->get();

            $timelines = $this->timelineService->getTimelineBySubAndMajor($sub->id, Auth::user()->major_id);
        } else {
            $filters = [
                'majorId' => request()->input('majorId'),
            ];

            $documents = Document::with(['user'])
                ->byMajorId($filters['majorId'])
                ->byStandardId($standard->id)
                ->bySubId($sub->id)
                ->Verified()
                ->latest()
                ->get();

            $timelines = $this->timelineService->getTimelineBySubAndMajor($sub->id, $filters['majorId']);
        }

        return Inertia::render('Documents/Subs/Show', compact('standard', 'sub', 'documents', 'timelines'));
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        $this->documentService->deleteDocumentById($document->id);

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menghapus sebuah dokumen.',
        ]);
    }
}

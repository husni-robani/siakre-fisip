<?php

namespace App\Observers;

use App\Enums\TimelineStatus;
use App\Models\Document;
use App\Services\TimelineService;

class DocumentObserver
{
    protected TimelineService $timelineService;

    public function __construct(TimelineService $timelineService)
    {
        $this->timelineService = $timelineService;
    }


    public function created(Document $document)
    {
        $this->timelineService->addTimeline($document->user_id, $document->sub_id, $document->major_id, TimelineStatus::Upload, "Melakukan upload dokumen pada sub {$document->sub->name} dengan judul dokumen {$document->name}.");
    }

    public function updated(Document $document)
    {
        $this->timelineService->addTimeline(\Auth::user()->id, $document->sub_id, $document->major_id, TimelineStatus::Verified, "Melakukan verifikasi dokumen pada sub {$document->sub->name} dengan judul dokumen {$document->name}.");
    }

    public function deleting(Document $document)
    {
        $this->timelineService->addTimeline(\Auth::user()->id, $document->sub_id, $document->major_id, TimelineStatus::Delete, "Melakukan penghapusan dokumen pada sub {$document->sub->name} dengan judul dokumen yang dihapus adalah {$document->name}");
    }

    public function deleted(Document $document)
    {

    }

    public function restored(Document $document)
    {
    }

    public function forceDeleted(Document $document)
    {
    }
}

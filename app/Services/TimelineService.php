<?php

namespace App\Services;

use App\Enums\TimelineStatus;
use App\Models\Timeline;

class TimelineService
{
    public function addTimeline(string $user_id, string $sub_id, string $major_id, TimelineStatus $operation, string $content)
    {
        Timeline::create([
            'user_id' => $user_id,
            'sub_id' => $sub_id,
            'major_id' => $major_id,
            'operation' => $operation,
            'content' => $content,
        ]);
    }

    public function getTimelineBySubAndMajor(string $sub_id, string $major_id)
    {
        return Timeline::with(['user', 'document', 'major', 'sub'])
            ->byMajor($major_id)
            ->bySub($sub_id)
            ->latest()
            ->limit(10)
            ->get();
    }

}

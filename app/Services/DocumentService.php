<?php

namespace App\Services;

use App\Enums\StatusDocument;
use App\Models\Document;
use App\Models\User;
use Exception;
use Storage;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DocumentService
{
    public function uploadDocument(string $userId, string $subId, string $majorId, StatusDocument $status, string $name, UploadedFile $file)
    {
        $document = Document::create([
            'user_id' => $userId,
            'sub_id' => $subId,
            'major_id' => $majorId,
            'status' => $status,
            'name' => $name,
            'file' => $this->moveFileToPublic($file, $file->getClientOriginalName()),
        ]);

        return $document;
    }

    protected function moveFileToPublic(UploadedFile $file, string $fileName): string
    {
        if (Storage::putFileAs('documents', $file, $fileName)) {
            return $fileName;
        }

        return "";
    }

    public function getDocumentsByStandardId(User $user, string $standardId)
    {
        if ($user->major) {
            return $documents = Document::with(['user', 'sub'])
                ->byMajorId($user->major_id)
                ->byStandardId($standardId)
                ->latest()
                ->get();
        } else {
            return $documents = Document::with(['user', 'sub'])
                ->byStandardId($standardId)
                ->latest()
                ->get();
        }
    }

    public function deleteDocumentById(string $id)
    {
        Document::find($id)
            ->delete();
    }
}

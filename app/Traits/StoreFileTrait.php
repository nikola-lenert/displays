<?php


namespace App\Traits;


use App\Models\File;
use Illuminate\Http\Request;

trait StoreFileTrait
{
    public function storeFile(Request $request, $field = 'file', $path = '')
    {
        $file = $request->file($field);

        if (!$file || !$file->isValid()) {
            return false;
        }

        $file->store($path);

        $fileObject = new File([
            'name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'path' => $file->hashName($path)
        ]);

        $fileObject->save();

        return $fileObject->id;
    }
}

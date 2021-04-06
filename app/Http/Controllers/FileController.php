<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Models\File;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    use ResponseTrait;

    public function fetch(Request $request) {
        $file = File::query()->find($request->route('id'));

        if (!$file) {
            return $this->notFoundResponse(File::class);
        }

        try {
            return Storage::download($file->path);
        } catch (\Throwable $e) {
            return new ErrorResource([
                "messages" => __('response.download_failed', ['object' => __('models.display')]),
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}

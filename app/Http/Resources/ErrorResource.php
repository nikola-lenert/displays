<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'errors';

    public function toArray($request)
    {
        $messages = $this->resource['messages'] ?? [];
        return [
            'messages' => !is_array($messages) ? [$messages] : $messages,
            'validation' => $this->resource['validation'] ?? null,
        ];
    }

    public function withResponse($request, $response)
    {
        $defaultStatusCode = isset($this->resource['validation']) ? Response::HTTP_BAD_REQUEST : Response::HTTP_INTERNAL_SERVER_ERROR;
        $statusCode = $this->resource['status'] ?? $defaultStatusCode;
        $response->setStatusCode($statusCode);
    }
}

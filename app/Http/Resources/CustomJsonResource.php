<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CustomJsonResource extends JsonResource
{


    public function with($request)
    {
        return [
            'warnings' => []
        ];
    }
}

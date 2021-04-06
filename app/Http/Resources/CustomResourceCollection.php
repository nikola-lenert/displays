<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomResourceCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'warnings' => []
        ];
    }
}

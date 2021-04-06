<?php

namespace App\Http\Resources;


class DisplayResource extends CustomJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'serial_number' => $this->serial_number,
            'display_type' => new DisplayTypeResource($this->displayType),
            'reseller' => new ResellerResource($this->reseller),
            'image' => $this->image->url ?? null
        ];
    }
}

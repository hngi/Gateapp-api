<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Visitor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /*[
            'estate_name' => $this ->estate_name,
            'estate_name' => $this ->estate_name,
        ];*/
    }
}

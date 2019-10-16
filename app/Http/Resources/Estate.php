<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Estate extends JsonResource
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
            'estate_id' => $this ->estate_id,
            'estate_name' => $this ->estate_name,
            'city' => $this ->city ,
            'country' => $this ->country 
             

        ];*/
    }
}

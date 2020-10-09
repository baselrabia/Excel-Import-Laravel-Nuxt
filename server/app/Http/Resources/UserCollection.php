<?php

namespace App\Http\Resources;

use App\File;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'num_neglected' => File::latest()->where('num_neglected','>',0)->first()->num_neglected,
            'data' =>  parent::toArray($request)
        ];
    }
}

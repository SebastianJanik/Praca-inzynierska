<?php

namespace App\Http\Resources\TeamUsers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamUsersStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
        ];
    }
}

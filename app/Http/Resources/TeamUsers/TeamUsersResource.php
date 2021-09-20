<?php

namespace App\Http\Resources\TeamUsers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamUsersResource extends JsonResource
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
            'league_id'=> $this->league_id,
        ];
    }
}
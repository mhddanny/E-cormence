<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
          'username' => $this->username,
          'password' => $this->password,
          'name' => $this->name,
          'email' => $this->email,
          'level' => $this->level
        ];
    }
}

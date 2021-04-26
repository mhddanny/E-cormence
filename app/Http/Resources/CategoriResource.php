<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriResource extends JsonResource
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
          'kd_kategori'=>$this->kd_kategori,
          'kategori'=>$this->kategori,
          'parent_id'=>$this->parent_id,
          'slug'=>$this->slug,
          'tipe'=>$this->tipe,
          'gambar_kategori'=>env('ASSET_URL')."/uploads/".$this->gambar_kategori
        ];
    }
}

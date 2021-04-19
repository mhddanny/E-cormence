<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
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
          'kd_produk'=>$this->kd_produk,
          'kd_kategori'=>$this->kd_kategori,
          'kode'=>$this->kode,
          'name'=>$this->name,
          'price'=>$this->price,
          'weight'=>$this->weight,
          'description'=>$this->description,
          'status'=>$this->status,
          'slug'=>$this->slug,
          'image'=>env('ASSET_URL')."/uploads/".$this->image
        ];
    }
}

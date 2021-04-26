<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk1 = new \App\Models\Produk;
        $produk1->kd_kategori =  1;
        $produk1->user_id =  1;
        $produk1->kode = 12345;
        $produk1->name = "Tas Gucci";
        $produk1->price = 270000;
        $produk1->weight = 300;
        $produk1->description = "Produk Original,<br> <p>Bahan Produksi Jerman</p>";
        $produk1->status = 1;
        $produk1->slug = "Tas Gucci";
        $produk1->image = "produk/Tas Gucci Original.jpg";
        $produk1->save();

        $produk2 = new \App\Models\Produk;
        $produk2->kd_kategori =  1;
        $produk2->user_id =  1;
        $produk2->kode = 12367;
        $produk2->name = "Tas Dowa";
        $produk2->price = 870000;
        $produk2->weight = 300;
        $produk2->description = "Produk Original,<br> <p>Bahan Terbuat dari Kulit Domba</p>";
        $produk2->status = 1;
        $produk2->slug = "Tas Dowa";
        $produk2->image = "produk/dowa.jpeg";
        $produk2->save();

        $produk3 = new \App\Models\Produk;
        $produk3->kd_kategori =  1;
        $produk3->user_id =  1;
        $produk3->kode = 12398;
        $produk3->name = "Tas Coach";
        $produk3->price = 2870000;
        $produk3->weight = 300;
        $produk3->description = "Produk Original,<br> <p>Bahan Terbuat dari Kulit Domba</p>";
        $produk3->status = 1;
        $produk3->slug = "Tas Coach";
        $produk3->image = "produk/coach.jpeg";
        $produk3->save();

        $produk4 = new \App\Models\Produk;
        $produk4->kd_kategori =  2;
        $produk4->user_id =  1;
        $produk4->kode = 12378;
        $produk4->name = "Dompet Gucci";
        $produk4->price = 130000;
        $produk4->weight = 300;
        $produk4->description = "Produk Original,<br> <p>Bahan Terbuat dari Kulit Domba</p>";
        $produk4->status = 1;
        $produk4->slug = "Dompet Gucci";
        $produk4->image = "produk/Dompet_gucci.jpg";
        $produk4->save();

        $produk5 = new \App\Models\Produk;
        $produk5->kd_kategori =  3;
        $produk5->user_id =  1;
        $produk5->kode = 16378;
        $produk5->name = "Ransel Kulit";
        $produk5->price = 130000;
        $produk5->weight = 300;
        $produk5->description = "Produk Original,<br> <p>Bahan Terbuat dari Kulit Domba</p>";
        $produk5->status = 1;
        $produk5->slug = "Ransel Kulit";
        $produk5->image = "produk/Ransel kulit.jpeg";
        $produk5->save();
        $this->command->info('Produk Seccesfuly');

    }
}

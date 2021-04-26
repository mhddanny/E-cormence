<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = new \App\Models\Category;
        $category1->kategori = 'Tas-Wanita';
        $category1->slug = 'Tas-Wanita';
        $category1->tipe = 'Fashion Wanita';
        $category1->gambar_kategori = "category/model_tas.jpeg";
        $category1->save();

        $category2 = new \App\Models\Category;
        $category2->kategori = 'Dompet-Wanita';
        $category2->slug = 'Dompet-Wanita';
        $category2->tipe = 'Fashion Wanita';
        $category2->gambar_kategori = "category/model_dompet.jpeg";
        $category2->save();

        $category3 = new \App\Models\Category;
        $category3->kategori = 'Ransel-Pria';
        $category3->slug = 'Ransel-Pria';
        $category3->tipe = 'Fashion Pria';
        $category3->gambar_kategori = "category/medel_Ransel.jpeg";
        $category3->save();
        $this->command->info('Category Seccesfuly');
    }
}

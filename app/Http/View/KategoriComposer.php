<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Category;

class KategoriComposer
{
    public function compose(View $view)
    {
        //JADI QUERY TADI KITA PINDAHKAN KESINI
        $kategories = Category::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
      	//KEMUDIAN PASSING DATA TERSEBUT DENGAN NAMA VARIABLE CATEGORIES
        $view->with('kategories', $kategories);
    }
}

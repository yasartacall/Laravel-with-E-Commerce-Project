<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function render()
    {
        $datalist = Product::where('title', 'like', '%'.$this->search.'%')->get();// title a göre arama yaptık başında ve sonunda ne olursa olsun geçiyor mu bu 

        return view('livewire.search', ['datalist' => $datalist, 'query' => $this->search]);// query değişkenini boş olup olmaması açısından kontrol etmek içinmiş hoca da tam blimiyo
    }

    // return view('livewire.search');
}

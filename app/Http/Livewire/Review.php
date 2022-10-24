<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;



class Review extends Component
{
    public $record, $subject, $review, $product_id, $rate;


    public function mount($id) // blade den göndrdiğimiz id buraya geliyo önce
    {
        $this->record = Product::findOrFail($id); // bu id ye ait ürünü alıyorum record olarak kaydediyorum
        $this->product_id = $this->record->id; // bu ürünün id sini de product id olarak alıyorum
    }

    public function render()
    {
        return view('livewire.review');
    }

    public function resetInput()
    {
        $this->subject = null;
        $this->review = null;
        $this->rate = null;
        $this->product_id = null;
        $this->IP = null;
    }

    public function store()
    {
        $this->validate([ // olması gerekenleri burda belirtiyoruz
            'subject' => 'required|min:5',
            'review' => 'required|min:10',
            'rate' => 'required'
        ]);

        \App\Models\Review::create([
            'product_id' => $this->product_id,
            'user_id' => Auth::id(),
            'IP' => $_SERVER['REMOTE_ADDR'],
            'rate' => $this->rate,
            'subject' => $this->subject,
            'review' => $this->review
        ]);

        session()->flash('message', 'Revire Send Successfully.');
        $this->resetInput();
    }
}

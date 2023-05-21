<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class CreateProduct extends Component
{
    public $state = [
        'title' => null,
        'description' =>  null,
        'price' => '0.00',
        'live' => null,
        'slug' => null
    ];
    public function render()
    {
        return view('livewire.create-product');
    }

    public function create()
    {

    }

    public function updatedStateTitle($title)
    {
        $this->state['slug'] = Str::slug($title);
    }
}

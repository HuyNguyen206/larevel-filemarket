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

    protected $rules = [
        'state.title' => 'required|max:255',
        'state.description' => 'required|max:1000',
        'state.price' => 'required|numeric'
    ];


    public function render()
    {
        return view('livewire.create-product');
    }

    public function create()
    {
        $this->validate();


    }

    public function updatedStateTitle($title)
    {
        $this->state['slug'] = Str::slug($title);
    }
}

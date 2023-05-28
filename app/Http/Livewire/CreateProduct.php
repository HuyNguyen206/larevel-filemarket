<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $uploads = [];
    public $files = [];
    public $state = [
        'title' => null,
        'description' =>  null,
        'price' => '0.00',
        'live' => false,
        'slug' => null
    ];

    protected $rules = [
        'state.title' => 'required|max:255',
        'state.slug' => 'required|unique:products,slug',
        'state.description' => 'required|max:1000',
        'state.price' => 'required|decimal:0,2|min:1',
        'files.*' => ['required', 'file', 'max:1024']
    ];


    public function render()
    {
        return view('livewire.create-product');
    }

    public function create()
    {
        $data = $this->validate();
        $product = Product::create($this->state + ['user_id' => auth()->id()]);
        $filesData = [];
        foreach ($data['files'] as $file) {
            $fileData['name'] = $file->getClientOriginalName();
            $fileData['path'] =  $file->store('products/files');
            $filesData[] = $fileData;
        }
        $product->files()->createMany($filesData);

        return $this->redirect(route('products.index'));
    }

    public function updatedUploads($uploads)
    {
        $this->files = array_merge($this->files, $uploads);
        $this->uploads = [];
    }

    public function removeFile($index)
    {
        unset($this->files[$index]);
    }


    public function updatedStateTitle($title)
    {
        $this->state['slug'] = Str::slug($title);
    }
}

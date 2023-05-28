<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public Product $product;
    public $uploads = [];
    public $files = [];
    public $existingFiles = [];

    public $removedExistingFileIds = [];

    public $state = [
        'title' => null,
        'description' =>  null,
        'price' => '0.00',
        'live' => false,
        'slug' => null
    ];

    protected function rules()
    {
        return [
            'state.title' => 'required|max:255',
            'state.description' => 'required|max:1000',
            'state.price' => 'required|decimal:0,2|min:1',
            'state.slug' => ['required', Rule::unique('products', 'slug')->ignore($this->product->id)],
            'files.*' => ['file', 'max:1024']
        ];
    }

    public function mount()
    {
        $this->state = Arr::only($this->product->withoutRelations()->toArray(), ['title', 'description', 'price', 'live', 'slug']);
        $this->state['price'] = money($this->state['price']['amount'])->formatByDecimal();
        $this->existingFiles = $this->product->files;
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

    public function removeExistFile($id)
    {
        $this->removedExistingFileIds[] = $id;
        $this->existingFiles = $this->existingFiles->filter(function ($file) use($id){
            return $file->id !== $id;
       });
    }

    public function updatedStateTitle($title)
    {
        $this->state['slug'] = Str::slug($title);
    }

    public function render()
    {
//        $this->files = $this->product->files;

        return view('livewire.edit-product');
    }

    public function update()
    {
        $data = $this->validate();
        $this->product->update($this->state);

        if (count($this->removedExistingFileIds)) {
            $fileBuilder = $this->product->files()->whereIn('id', $this->removedExistingFileIds);
            $deletedPaths = $fileBuilder->get()->pluck('path')->toArray();
            Storage::delete($deletedPaths);
            $fileBuilder->delete();
        }

        if (isset($data['files'])) {
            $filesData = [];
            foreach ($data['files'] as $file) {
                $fileData['name'] = $file->getClientOriginalName();
                $fileData['path'] =  $file->store('products/files');
                $filesData[] = $fileData;
            }
            $this->product->files()->createMany($filesData);
        }
        session()->flash('success', 'Update product successfully!');
        return $this->redirect(route('products.index'));
    }
}

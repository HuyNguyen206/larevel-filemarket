<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid md:grid-cols-3  grid-cols-1 gap-6">
            @foreach($products as $product)
            <a href="" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-center items-center h-44">
                <div class="p-6 text-gray-900">
                        {{$product->title}}
                </div>
            </a>
            @endforeach
                <a href="{{route('products.create')}}" class="overflow-hidden shadow-sm sm:rounded-lg flex justify-center items-center h-44 bg-gray-300">
                    <div class="p-6 text-gray-900">
                        + Create product
                    </div>
                </a>
        </div>
    </div>
</x-app-layout>

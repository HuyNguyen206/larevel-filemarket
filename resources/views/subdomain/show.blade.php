<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-lg font-semibold text-gray-900">
                   {{$product->title}} by <a class="text-purple-800" href="{{route('subdomain.index', $user)}}">{{$user->name}}</a>
                </div>
                <p>{{$product->description}}</p>
            </div>
        </div>
        <div class="flex justify-center mt-2">
            <x-primary-button>
                Buy for {{$product->price}}
            </x-primary-button>
        </div>


    </div>
</x-guest-layout>

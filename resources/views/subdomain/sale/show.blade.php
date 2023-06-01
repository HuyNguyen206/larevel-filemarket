<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p>Thank you for buying <em>{{$product->title}}</em> from <a class="font-semibold text-purple-800" href="{{route('subdomain.products.index', $user)}}">{{$user->name}}</a></p>
            </div>
        </div>

    </div>
</x-guest-layout>

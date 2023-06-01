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
                    {{$user->name}}'s market place
                </div>
            </div>
        </div>
        <ul>
            @forelse($products as $product)
                <li>
                    <a class="text-purple-800 font-semibold" href="{{route('subdomain.products.show', ['user' => $user, 'product' => $product])}}">{{$product->title}}</a>
                </li>
            @empty
                <li>
                    <span>No data</span>
                </li>
            @endforelse
        </ul>

    </div>
</x-guest-layout>

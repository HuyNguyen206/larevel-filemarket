<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <dl class="grid grid-cols-2 gap-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <dt class="p-6 text-gray-500">
                        Sales
                    </dt>
                    <dd class="p-6 text-gray-900 font-semibold text-2xl">
                        {{$sale->sales_count}}
                    </dd>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <dt class="p-6 text-gray-500">
                        Sales volume
                    </dt>
                    <dd class="p-6 text-gray-900 font-semibold text-2xl">
                        {{money($sale->sales_sum_price)}}
                    </dd>
                </div>

            </dl>
            <div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sale->sales as $s)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="text-purple-800" href="{{route('subdomain.products.show', [$user->subdomain, $s->product->slug])}}">{{$s->product->title}}</a>
                                </th>
                                <td class="px-6 py-4">
                                    {{$s->email}}
                                </td>
                                <td class="px-6 py-4">
                                    {{money($s->price)}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$s->created_at}}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

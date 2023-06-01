<x-mail::message>
# Your purchase was succeed

Enjoy your purchase

<x-mail::button :url="$link">
Go to the material
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

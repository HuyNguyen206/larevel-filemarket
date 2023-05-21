<div class="bg-white p-8">
    <form wire:submit.prevent="create">
        <section>
            <header class="text-xl font-bold">
                Product information
            </header>
            <p>
                Add the basis detail for your product
            </p>
            <div>
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')"/>

                    <x-text-input wire:model.lazy="state.title" id="title" class="block mt-1 w-full"
                                  type="text"
                    />

                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="slug" :value="__('Slug')"/>

                    <x-text-input readonly wire:model.lazy="state.slug" id="slug" class="block mt-1 w-full"
                                  type="text"
                    />

                    <x-input-error :messages="$errors->get('slug')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')"/>

                    <x-textarea-input wire:model.lazy="state.description" id="description" class="block mt-1 w-full"></x-textarea-input>

                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="price" :value="__('Price')"/>

                    <x-text-input wire:model.lazy="state.price" id="price" class="block mt-1 w-full"
                                  type="number"
                    />

                    <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                </div>

                <div class="block mt-4">
                    <label for="Live" class="inline-flex items-center">
                        <input wire:model.lazy="state.live" id="Live" type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                               name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Live') }}</span>
                    </label>
                </div>
            </div>
        </section>
        <section class="mt-4">
            <header class="text-xl font-semibold">
                Add file
            </header>
            <div>
                Attach your product
            </div>
        </section>

        <x-primary-button>
            {{ __('Create product') }}
        </x-primary-button>

    </form>
</div>

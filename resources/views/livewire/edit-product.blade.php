<div class="bg-white p-8">
    <form wire:submit.prevent="update">
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

                    <x-input-error :messages="$errors->get('state.title')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="slug" :value="__('Slug')"/>

                    <x-text-input readonly wire:model="state.slug" id="slug" class="block mt-1 w-full"
                                  type="text"
                    />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')"/>

                    <x-textarea-input wire:model.lazy="state.description" id="description" class="block mt-1 w-full"></x-textarea-input>

                    <x-input-error :messages="$errors->get('state.description')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="price" :value="__('Price')"/>

                    <x-text-input wire:model.lazy="state.price" id="price" class="block mt-1 w-full"
                                  type="number" step=".01"
                    />

                    <x-input-error :messages="$errors->get('state.price')" class="mt-2"/>
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
        <section class="my-4">
            <header class="text-xl font-semibold">
                Add file
            </header>
            <div>
                <div class="mt-4">
                    <x-input-label for="price" :value="__('Price')"/>

                    <x-text-input wire:model="uploads" class="block mt-1 w-full"
                                  type="file" multiple
                    />
                    <ul class="my-2">
                        @foreach($existingFiles as $existFile)
                            <li>
                                {{$existFile->name}} <span class="inline-block ml-2 text-red-700 cursor-pointer" wire:click="removeExistFile({{$existFile->id}})">&times;</span>
                            </li>
                        @endforeach
                        @foreach($files as $index => $file)
                            <li>
                                {{$file->getClientOriginalName()}} <span class="inline-block ml-2 text-red-700 cursor-pointer" wire:click="removeFile({{$index}})">&times;</span>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </section>

        <x-primary-button>
            {{ __('Update product') }}
        </x-primary-button>

    </form>
</div>

<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form method="POST" action="/posts">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-10">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Blog</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Create your article in here</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="title" id="title" autocomplete="off"
                                placeholder="How to Install" required/>
                                <x-form-error name="title"/>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="category_id">Category</x-form-label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                <select name="category_id" id="category_id"
                                    class="block w-full pl-3 pr-10 py-1.5 text-gray-900 border-0 focus:ring-0 sm:text-sm sm:leading-6">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </x-form-field>

                    <div class="col-span-full">
                        <x-form-label for="body">Artikel</x-form-label>
                        <div class="mt-2">
                            <textarea id="body" name="body" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <x-form-error name="body"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/posts" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form-button>Save</x-form-button>
        </div>
    </form>

</x-layout>

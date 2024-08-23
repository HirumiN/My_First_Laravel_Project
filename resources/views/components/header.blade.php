<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $slot }}</h1>
        @if (request()->is('posts'))
            <x-button href="/posts/create">Create Post</x-button>
        @endif
    </div>
</header>

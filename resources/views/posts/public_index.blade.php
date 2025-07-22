<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Published Posts</h1>

        @forelse ($posts as $post)
            <div class="border border-gray-300 bg-white rounded-xl shadow-sm mb-6 p-6 transition hover:shadow-md">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-2">
                    <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h3>
                <p class="text-gray-600 text-base leading-relaxed mb-3">
                    {{ Str::limit($post->content, 300) }}
                </p>
                <p class="text-sm text-gray-500">
                    Posted by: <span class="font-medium">{{ $post->user->name ?? 'Unknown' }}</span>
                </p>
            </div>
        @empty
            <div class="text-center text-gray-500">
                No published posts found.
            </div>
        @endforelse
    </div>
</x-app-layout>

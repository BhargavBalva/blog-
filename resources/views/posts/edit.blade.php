<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
            {{ isset($post) ? 'Edit' : 'Create' }} Post
        </h1>

        <form method="POST" action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}"
              class="bg-white p-8 rounded-lg shadow space-y-6">
            @csrf
            @if(isset($post)) @method('PUT') @endif

            <div>
                <input type="text"
                       name="title"
                       value="{{ old('title', $post->title ?? '') }}"
                       placeholder="Enter Post Title"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <div>
                <textarea name="content"
                          placeholder="Write your content here..."
                          required
                          rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >{{ old('content', $post->content ?? '') }}</textarea>
            </div>

            <div>
                <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="draft" @selected(old('status', $post->status ?? '') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $post->status ?? '') === 'published')>Published</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('posts.index') }}"
                   class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="btn-btn danger">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

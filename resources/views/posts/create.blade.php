<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
            {{ isset($post) ? 'Edit' : 'Create' }} Post
        </h1>

        <form method="POST" action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}"
            class="bg-white p-8 rounded-xl shadow-md space-y-6">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Enter post title">
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="content" name="content" required rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Write your post content here...">{{ old('content', $post->content ?? '') }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="draft" @selected(old('status', $post->status ?? '') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $post->status ?? '') === 'published')>Published</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('posts.index') }}"
                    class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Cancel</a>
                <button type="submit"
                    class="btn-btn primary">
                    {{ isset($post) ? 'Update' : 'Create' }} Post
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

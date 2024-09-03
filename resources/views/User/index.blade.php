<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Profile info here -->
            @foreach($profile as $user)
            <div>{{ $user->name }}</div>
            <div>{{ $user->email }}</div>
            @endforeach
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button><a href='{{ route('post.create') }}'>Post</a></x-primary-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Profile!") }}
                    @forelse ($posts as $post)
                    <div>{{ $post->title }}</div>
                    <div>{{ $post->text }}</div>
                    <div>{{ $post->updated_at->DiffForHumans(); }}</div>

                    @empty 
                    <div>No Posts Yet</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

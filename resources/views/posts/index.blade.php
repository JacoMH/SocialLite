<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button><a href='{{ route('post.create') }}'>Post</a></x-primary-button>
                <div class="p-6 text-gray-900">
                    @forelse ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2 p-6">
                        <section class='flex'>
                            <!-- profile -->
                            <div name='Profile' class=' pr-4 mt-2'>
                                <a href='{{ route('User.index', $post->user_id)}}'><img class=' rounded-full max-w-[100px]'src='{{$post->ProfilePicture}}'></img></a>
                                <div class='text-center'>{{ $post->name}}</div>
                            </div>
        
                            <!-- post -->
                            <div name='comment' class='self-center'>
                                <div class='text-3xl text-blue-600'>{{ $post->title}}</div>
                                <div class='mt-1'>{{ $post->text}}</div>
                                <div class=' mt-1 text-blue-400 hover:underline'><a href='{{ route('post.show', $post->id) }}'>Comments</a></div>
                                <span class=' mt-2 text-gray-500'>{{ $post->updated_at->DiffForHumans(); }}</span>
                            </div>
                        </section>
                    </div>
                    @empty
                    <div>No Posts Yet</div>              
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

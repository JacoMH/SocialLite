<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button><a href='{{ route('post.create') }}'>Post</a></x-primary-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 text-gray-900">
                    @foreach ($posts as $post)
                    <div>
                        <!-- profile -->
                        <div>
                            
                        </div>

                        <!-- content -->
                        <div>
                            <div class='text-3xl text-blue-600'>{{ $post->title }}</div>
                            <div class=' mt-1'>{{ $post->text }}</div>
                            <span class=' mt-2 text-gray-500'>{{ $post->updated_at->DiffForHumans(); }}</span>
                        </div>
                    </div>              
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

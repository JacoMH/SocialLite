<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 text-gray-900">
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

                        <!-- comment box -->
                        <form method='POST' class='flex flex-col' action="{{ route('comment.store')}}">
                            @csrf
                            <x-text-area name='CommentText'></x-text-area>
                            <input type='hidden' name='value' value={{ $post->id }}></input> <!-- may have to change this as am not sure if its a security issue -->
                            @error('CommentText')
                            <div class='bg-red-500 text-xs'> {{ $message }}</div>
                            @enderror
                            <x-primary-button class=' max-w-[50px] w-full'>Comment</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- already made comments -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                already made comments go here
            </div>
        </div>
    </div>
</x-app-layout>

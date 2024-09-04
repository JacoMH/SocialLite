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
                        <div>
                            @if(session()->has('AlertMessage'))
                            <!-- alert when comment is made -->
                            <span class=' p-3 w-[80%] border-green-700 bg-green-500 rounded-md'>{{session()->get('AlertMessage')}}</span>
                            @endif
                        </div>
                        <form method='POST' class='flex flex-col mt-1' action="{{ route('comment.store', $post)}}"> <!-- not passing post attributes to the controller -->
                            @csrf
                            <x-text-area name='CommentText'></x-text-area>
                      
                            @error('CommentText')
                            <div class='bg-red-500 text-xs'> {{ $message }}</div>
                            @enderror
                            <x-primary-button class=' max-w-[100px] w-full mt-1 self-end'>Comment</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- already made comments -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                @forelse($comments as $comment)
                <div> {{ $comment->text}} </div>
                @empty
                <div>No comments yet</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

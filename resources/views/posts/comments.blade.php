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
                        <section class='flex'>
                            <!-- profile -->
                            <div name='Profile' class=' pr-4 mt-2'>
                                <img class=' rounded-full max-w-[100px]'src='{{$UserPost->ProfilePicture}}'></img>
                                <div class='text-center'>{{ $UserPost->name}}</div>
                            </div>
        
                            <!-- post -->
                            <div name='comment' class='self-center'>
                                <div class='text-3xl text-blue-600'>{{ $UserPost->title}}</div>
                                <div class='mt-1'>{{ $UserPost->text}}</div>
                                <span class=' mt-2 text-gray-500'>{{ $UserPost->updated_at->DiffForHumans(); }}</span>
                            </div>
                        </section>

                        <!-- comment box -->
                        <div>
                            @if(session()->has('AlertMessage'))
                            <!-- alert when comment is made -->
                            <span class=' p-3 w-[80%] border-green-700 bg-green-500 rounded-md'>{{session()->get('AlertMessage')}}</span>
                            @endif
                        </div>
                        <form method='POST' class='flex flex-col mt-1' action="{{ route('comment.store')}}"> <!-- not passing post attributes to the controller -->
                            @csrf
                            <x-text-area name='CommentText'></x-text-area>
                            <input type='hidden' name='postID' value='{{ $UserPost->id }}'></input> <!-- not sure if it is a security risk -->
                            @error('CommentText')
                            <div class='bg-red-500 text-xs'> {{ $message }}</div>
                            @enderror
                            <x-primary-button class=' max-w-[100px] w-full mt-1 self-end'>Comment</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- already made comments -->
                @forelse ($PostComment as $comment)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2 p-2 flex flex-col">
                    <section class='flex'>
                        <!-- profile -->
                        <div name='Profile' class=' pr-4 mt-2'>
                            <img class=' rounded-full max-w-[100px]'src='{{$comment->ProfilePicture}}'></img>
                            <div class='text-center'>{{ $comment->name}}</div>
                        </div>
    
                        <!-- comment -->
                        <div name='comment' class='self-center'>
                            <div>{{ $comment->text}}</div>
                            <span class=' mt-2 text-gray-500'>{{ $comment->updated_at->DiffForHumans(); }}</span>
                        </div>
                    </section>
                </div>   
                    @empty
                    <div>No comments yet</div>
                    @endforelse 
        </div>
    </div>
</x-app-layout>

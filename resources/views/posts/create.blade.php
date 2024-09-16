<script type='text/javascript' src='{{ asset('resources\js\test.js')}}' defer></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div>
                    @if(session()->has('AlertMessage'))
                    <!-- alert when post is made -->
                    <span class=' p-3 w-[80%] border-green-700 bg-green-500 rounded-md'>{{session()->get('AlertMessage')}}</span>
                    @endif
                </div>
                <div class="p-6 text-gray-900">
                 <form method='POST' action="{{ route('post.store')}} " class=' flex flex-col items-center' enctype='multipart/form-data'>
                 @csrf
                 <x-text-input name='title' placeholder='Title here' value="{{ @old('title')}}" class='mt-2 min-w-[600px]'></x-text-input>
                 @error('title')
                 <div class=' text-red-500 text-xs'>{{ $message }}</div>
                 @enderror
                 <x-text-input name='text' placeholder='Text here' value="{{ @old('title')}}" class='mt-2 min-w-[600px]'></x-text-input>
                 @error('text')
                 <div class='text-red-500 text-xs'>{{ $message }}</div>
                 @enderror
                 <!-- insert image -->
                 <input type='file' id='image' multiple></input>
                 <div>
                    <span></span>
                    <img src=''><img>
                 </div>
                 <x-primary-button class='mt-2 min-w-[200px] justify-center'>Create Post</x-primary-button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


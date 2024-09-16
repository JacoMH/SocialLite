<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>
    <!-- search bar -->
    <form class=' flex justify-center' method='POST' action='{{ route('')}}'>
        <!--user or post dropdown-->


        <!--search-->
        <input  name='search' value="{{ @old('search')}}" type='text' class=' m-4 max-w-[500px] w-full'></input>
        <input type='submit' name='submitsearch'></input>
    </form>
    <div class="py-12">
        
    </div>
</x-app-layout>

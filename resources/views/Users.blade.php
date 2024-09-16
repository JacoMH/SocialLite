<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <!-- search bar -->
    <form class=' flex justify-center' method='GET' action='{{ route('search.query')}}'>
        <!--user or post dropdown-->


        <!--search-->
        <input  name='search' value="{{ @old('search')}}" type='text' class=' m-4 max-w-[500px] w-full'></input>
        <input type='submit' name='submitsearch'></input>
    </form>
    <div class="py-12">
        <!-- results -->
        @if (Route::currentRouteName() == 'search.query')
            @forelse($Query as $result)
                <div> {{ $result->title }}</div>
                <div> {{ $result->text }}</div>
            @empty
                <div>No results</div>
            @endforelse
        @endif

        @if (Route::currentRouteName() == 'search')
            @forelse($posts as $result)
            <div> {{ $result->title }}</div>
            <div> {{ $result->text }}</div>
            @empty
                <div>No posts</div>
            @endforelse
        @endif
    </div>
</x-app-layout>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div id='message'></div>
            <!-- Profile info here -->
            @foreach($profile as $user)
            <section name='profile' class=' flex self-center flex-col text-center'>
            <?php $name = $user->name;  ?>
            <img  class=' max-w-[200px] w-full rounded-full self-center'src='{{ $user->ProfilePicture }}'></img>
            <div class=' text-gray-600 text-2xl'>{{ $user->name }}</div>
            @endforeach
            </section>
            <div class='mt-1 flex justify-between'>
                <span class='pt-2'>{{ "Welcome back, " . $user->name . "!"}}</span>
                <div>{{ $user->email }}</div>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button><a href='{{ route('post.create') }}'>Post</a></x-primary-button> <!-- sort out the layout -->
            <section class='flex flex-col'>
                <div class="p-6 text-gray-900">
                    @forelse ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                        <div name='profileSection' class='mr-12'>
                            <img  class=' max-w-[100px] w-full rounded-full self-center'src='{{ $user->ProfilePicture }}'></img>
                            <div class=' text-gray-600 text-center'>{{ $user->name }}</div> 
                            <div class=' text-xs text-gray-600 text-end p-4'>{{ $post->updated_at->DiffForHumans(); }}</div>
                        </div>
                        <div name='postSection'>
                            <div class=' text-2xl text-blue-600'>{{ $post->title }}</div>
                            <div>{{ $post->text }}</div>    
                            <div class=' mt-1 text-blue-400 hover:underline'><a href='{{ route('post.show', $post) }}'>Comments</a></div>

                                <input type='hidden' name='postID' value='{{ $post->id }}'></input>
                                <form method='POST' action="{{url('ajaxupload')}}" id='likepost'>
                                @csrf
                                    <input type='hidden' value='{{$post->id}}' name='postID'>
                                    <input type='submit' class=' max-w-[100px] w-full mt-1 self-end' id='likebutton'>
                                </form>
                                <div id='message'></div>
                        </div>
                    </div>
                    @empty 
                    <div>No Posts Yet</div>
                </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>

<script type='text/javascript'>
    $(document).ready(function() {
        $("#likepost").on('submit',function(event){
        event.preventDefault();
        jQuery.ajax({
                    type:'POST',
                    url:"{{url('ajaxupload')}}",
                    data:jQuery('#likepost').serialize(),
                    type:post,
                    success:function(result) {
                        $('#message').css('display','block');
                        jQuery('#message').html(result.message);
                    }
                    });
    })
});
</script>


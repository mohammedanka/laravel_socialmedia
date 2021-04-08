@extends('layouts.app')

@section('content')

<h1>My Posts</h1>

@isset($all_posts)
    <ul class="w3-ul w3-card-4">
        @foreach($all_posts as $mypost)
            <li class="w3-bar">
                <form action="{{ route('posts.destroy', $mypost->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="w3-bar-item w3-button w3-white w3-xlarge w3-right">X</button>
                </form>
                <img src="/{{ $mypost->post_img_src }}" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
                <div class="w3-bar-item">
                    <span class="w3-large">{{ $mypost->post_text }}</span>
                    <br>
                    <span>{{ $mypost->updated_at }}</span>
                </div>
            </li>
        @endforeach
    </ul>
@endisset

@endsection
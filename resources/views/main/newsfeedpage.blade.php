@extends('layouts.app')

@section('content')

<h1>News Feed</h1>

@isset($posts)
@php $i = 0; @endphp
    <ul class="w3-ul w3-card-4">
        @foreach($posts as $mpost)
            <li class="w3-bar">
            <span class="w3-large">{{ $usersforthepost[$i] }}</span>
            @php $i++; @endphp
                <img src="/{{ $mpost->post_img_src }}" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
                <div class="w3-bar-item">
                    <span class="w3-large">{{ $mpost->post_text }}</span>
                    <br>
                    <span>{{ $mpost->updated_at }}</span>
                </div>
            </li>
        @endforeach
    </ul>
@endisset

@endsection
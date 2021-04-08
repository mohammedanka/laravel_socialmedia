@extends('layouts.app')

@section('content')

<h1>Add Post</h1>

@if (session('messagebad'))
    <div class="w3-panel w3-red">
        {{ session('messagebad') }}
    </div>
    <br>
@endif

@if (session('messagegood'))
    <div class="w3-panel w3-green">
        {{ session('messagegood') }}
    </div>
    <br>
@endif

<form action="/main/add" method="post" class="w3-container" enctype="multipart/form-data">
    @csrf
    <input class="w3-input w3-animate-input" type="text" style="width:135px" placeholder="enter text..." name="posttext"><br>
    <input class="w3-input w3-border w3-animate-input" type="file" style="width:30%" name="postimage">
    <br>
    <p>
        <button class="w3-btn w3-blue-grey" type="submit">Save</button>
    </p>
</form>

@endsection
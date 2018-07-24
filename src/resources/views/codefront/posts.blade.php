@extends('codefront::layout')

@section('content')

@foreach($posts as $post)  
<!-- Blog Post -->
<div class="card mb-4">
    <img class="card-img-top" src="data:image/jpg;base64,{{ $post->image }}" width="750px" height="300px" alt="Card image cap">
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        <p class="card-text">{{ str_limit(strip_tags($post->content), 250) }}</p>
        Category: 
        @foreach($post->categories as $category)
        <span class="badge badge-primary">{{ $category->name }}</span>
        @endforeach  <br><br>
        
        Tag: 
        @foreach($post->tags as $tag)
        <span class="badge badge-secondary">{{ $tag->name }}</span>
        @endforeach  <br><br>
        
        <a href="{{ route('search.post.slug', $post->slug) }}" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
        Posted on {{ $post->updated_at }} by
        <a href="#">{{ $post->user->name }}</a>
    </div>
</div>
@endforeach

@endsection
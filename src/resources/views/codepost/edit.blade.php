@extends('layouts.app')

@section('content')

<?php
    $textState = $post->state == $post::STATE_PUBLISHED ? "Draft" : "Publish";
    $classState = $post->state == $post::STATE_PUBLISHED ? "warning" : "success";
    $state = $post->state == $post::STATE_PUBLISHED ? $post::STATE_DRAFT : $post::STATE_PUBLISHED;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h4>Edit Post {{ $post->name }}</h4>
                    <h3>
                        <span class="badge badge-pill badge-{{$post->state == $post::STATE_PUBLISHED ? "success" : "warning"}} text-white">
                            {{ $post->state == $post::STATE_PUBLISHED ? "Published" : "Draft" }}
                        </span>
                    </h3>
                    {!! Form::model($post, ['route' => ['admin.posts.update', $post->id], 'method' => 'put']) !!}

                    <div class="form-group">
                        {!! Form::label('Title', 'Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Content', 'Content:') !!}
                        <textarea name="content" id="mytiny">{!! old('content') ? old('content') : $post->content !!}</textarea>
                        @include('tinymce::tpl')
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Edit Post', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                    
                    @can('publish_post')
                    {!! Form::model($post, ['route' => ['admin.posts.update_state', $post->id], 'method' => 'patch']) !!}
                    <div class="form-group">
                        {!! Form::hidden('state', $state) !!}
                        {!! Form::submit("$textState", ['class' => "btn btn-$classState btn-lg btn-block text-white"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
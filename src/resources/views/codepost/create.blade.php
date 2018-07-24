@extends('layouts.app')

@section('content')
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

                    <h4>Create Post</h4>
                    {!! Form::open(['route' => 'admin.posts.store', 'method' => 'post', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('Title', 'Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('image', 'Image:') !!}
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('categories', 'Categories:') !!}
                        {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => 'true']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('tags', 'Tags:') !!}
                        {!! Form::select('tags[]', $tags, null, ['class' => 'form-control', 'multiple' => 'true']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Content', 'Content:') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'mytiny']) !!}
                        @include('tinymce::tpl')
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create Post', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

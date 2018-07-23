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

                    <h2>Post - {{ $post->title }}</h2>
                    <div class="text-center p-3 mb-2 bg-dark text-white">
                        <strong>Author: </strong><a href="#" class="badge badge-light">{{ $post->user->name }}</a>
                    </div>

                    <p>{!! $post->content !!}</p>

                </div>
            </div>
        </div>
    </div>
    @include('codepost::_comment')
</div>
@endsection

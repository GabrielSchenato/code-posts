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

                    <h4>Comment from post - {{ $comment->post['title'] }}</h4>
                    {!! Form::model($comment) !!}

                    <fieldset disabled>

                        {!! Form::label('Content', 'Content:') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}

                    </fieldset>

                    {!! Form::close() !!}
                </div>
                <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary btn-sm">Back to Comments</a>
            </div>
        </div>
    </div>
</div>
@endsection

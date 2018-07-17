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
                    
                    
                    <a href="{{ route('admin.comments.deleted') }}" class="btn btn-dark btn-sm">Deleted Comments</a>

                    <br>
                    <br>
                    <hr>

                    <h4>Comments</h4>


                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Content</th>
                                <th>Post</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ str_limit($comment->content, 50) }}</td>
                                <td>{{ str_limit($comment->post['title'], 15) }}</td>
                                <td>
                                    <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn btn-outline-primary">Show comment</a>
                                    {!! Form::model($comment, ['route' => ['admin.comments.destroy', $comment->id], 'method' => 'delete', 'style' => 'display: inline;']) !!}
                                        {!! Form::submit('Delete comment', ['class' => 'btn btn-outline-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

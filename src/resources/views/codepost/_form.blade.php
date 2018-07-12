<div class="form-group">
    {!! Form::label('Title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'mytiny']) !!}
    @include('tinymce::tpl')
</div>
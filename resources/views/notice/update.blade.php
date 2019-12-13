@extends('layouts.app')
@section('title', 'Upate Task')
@section('content')
<div class="row">
    <div class="col-md-4 ml-auto mr-auto">
        <h1> Update a Notice</h1>
        {!! Form::model($task, ['route' => ['notice.update', $task->id], 'method' => 'PUT' ]) !!}
            @component('components.noticeForm')
            @endcomponent
        {!! Form::close() !!}
    </div>
</div>
@endsection()

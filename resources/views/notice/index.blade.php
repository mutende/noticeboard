@extends('layouts.app')
@section('title','Notices')
@section('content')

@if ($notices->count() == 0)
    <!-- btn to create a notice -->
    <!-- Large modal -->
    <div class="mt-5">
    <h5>You have not created any notice</h5>
        <a class="btn btn-primary" href="{{ route('notice.create') }}">Create notice</a>

    </div>



@else
<div class="row  wow slideInRight mt-5 col-md-12" data-wow-duration="2s">

    <table class="table table-sm table-hover" id="alltables">

            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col" style="width:200px;">Notice</th>
                <th scope="col">Due</th>
                <th scope="col" style="width:150px;">Sent to</th>
                <th scope="col">Platform</th>
                <th scope="col">Action</th>
                </tr>
            </thead>

        <tbody>
        <?php $count = 1; ?>
        @foreach ($notices as $notice )


        <tr>
        <td><?php echo $count; ?></td>
        <td>{{$notice->title}}</td>
        <td>{{$notice->due_date}}</td>
        <td>{{$notice->role->role}}</td>
        <td>{{$notice->platform}}</td>

        <td>
        {!! Form::open(['route'=>['notice.update', $notice->id], 'method'=>'DELETE']) !!}
             <a href="{{ route('notice.show', $notice->id) }}" class="btn btn-group-sm btn-primary">View</a>
                <button class="btn btn-group-sm btn-danger" type="submit">Delete</button>
             {!! Form::close() !!}

        </td>
        </tr>

        <?php $count++; ?>
        @endforeach

        </tbody>
    </table>
</div>
@endif



   {{--  <div class="row justify-content-center mt-5">
        <div class="col-10 text-center ml-auto mr-auto">
            {{$notices->links()}}
        </div>
    </div>
    --}}

@endsection

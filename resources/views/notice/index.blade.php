@extends('layouts.app')
@section('title','Notices')
@section('content')

@if ($notices->count() == 0 )
    <!-- btn to create a notice -->
    <!-- Large modal -->
    @if(Auth::user()->role_id == 1 )
    <div class="mt-5">
    <h5>You have not created any notice</h5>
        <a class="btn btn-primary" href="{{ route('notice.create') }}">Create notice</a>

    </div>
    @else
      <h5>You Do not have any notices</h5>
    @endif



@else
<div class="row  wow slideInRight mt-5 col-md-12" data-wow-duration="2s">

    <table class="table table-sm table-hover" id="alltables">

            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col" style="width:200px;">Notice</th>
                <th scope="col">Due</th>
                <th scope="col" style="width:100px;">Sent to</th>
                <th scope="col">Platform</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>

        <tbody>
        <?php $count = 1; ?>
        @foreach ($notices as $notice )
        @if($notice->role_id == Auth::user()->role_id || Auth::user()->role_id == 1 || $notice->role_id  == 7 )


        <tr>
        <td><?php echo $count; ?></td>
        <td>{{$notice->title}}</td>
        <td>{{$notice->due_date}}</td>
        <td>{{$notice->role->role}}</td>
        <td>{{$notice->platform}}</td>
        <td>
          @if($notice->status)
          <span class="text-success">Active</span>
          @else
        <span class="text-danger">Suspended</span>
          @endif
        </td>

        <td>
        {!! Form::open(['route'=>['notice.suspend', $notice->id], 'method'=>'PUT']) !!}
          @if($notice->status)
          <a href="{{ route('notice.show', $notice->id) }}" class="btn btn-group-sm btn-primary">View</a>
             <button class="btn btn-group-sm btn-danger" type="submit">Suspend</button>
          @else
          <a href="{{ route('notice.show', $notice->id) }}" class="btn btn-group-sm btn-primary disabled">View</a>
             <button class="btn btn-group-sm btn-danger disabled" type="submit">Suspend</button>
          @endif


             {!! Form::close() !!}

        </td>
        </tr>
        @else
        <?php continue; ?>
        @endif

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

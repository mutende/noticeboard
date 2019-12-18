@extends('layouts.app')
@section('title','Notice')
@section('content')

<div class="row  wow slideInRight mt-5" data-wow-duration="2s">
  <div class="col-md-6 offset-md-3 ">
    <div class="card">
      <div class="card-header text-center">
        <h4>{{$notice->title}}</h4>
         <small>Was created {{$notice->created_at}}</small>

      </div>
      <div class="card-body">
        <p>Notice to : {{$notice->role->role}}</p>
        <p>
        <h5>Notice Details</h5>
        {{$notice->details}}

        </p>
        <p>Sent via : {{$notice->platform}}</p>
        <p>Due Date:   <span>{{$notice->due_date}}</span></p>

        <div class="row">
          <div class="col-md-6">
            <form class="" action="" method="post">
               <a href="{{ route('notice.edit', $notice->id) }}" class="btn btn-group btn-sm btn-primary">Update</a>
                  <button type="submit" class="btn btn-sm btn-info text-white ml-3" name="button">Suspend</button>
            </form>



          </div>

        </div>
      </div>

    </div>
  </div>


</div>


@endsection

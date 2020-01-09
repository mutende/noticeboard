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
        <p>
          Notice to :
          <?php $num = 1; ?>
          @foreach($noticetoroles as $rs)
          @if($num > 1)
           , {{$rs->role->role}}
           @else
           {{$rs->role->role}}
           @endif
          <?php $num++?>
          @endforeach
        </p>
        <p>
        <h5>Notice Details</h5>
        {{$notice->details}}

        </p>
        <p>
          Sent via :
          <?php $num2 = 1; ?>
          @foreach($noticeplatforms as $np)
          @if($notice->id == $np->notice_id)
          @if($num2 > 1)
           , {{$np->platform}}
          @else
            {{$np->platform}}
          @endif
          @endif
          <?php $num2++; ?>
          @endforeach

        </p>
        <p>Due Date:   <span>{{$notice->due_date}}</span></p>

        <div class="row">
          <div class="col-md-6">
            <form class="" action="{{ route('notice.suspend', $notice->id )}}" method="post">
              {{csrf_field()}}
              {{method_field ('PUT')}}
              @if(Auth::user()->role_id == 1)
                @if($notice->status)
               <a href="{{ route('notice.edit', $notice->id) }}" class="btn btn-group btn-sm btn-primary">Update</a>
                  <button type="submit" class="btn btn-sm btn-warning ml-3 mr-3" name="button">Suspend</button>
                @endif
                @endif
                 <a href="{{ url('/') }}" class="btn btn-group btn-sm btn-info">Go back</a>
            </form>



          </div>

        </div>
      </div>

    </div>
  </div>


</div>


@endsection

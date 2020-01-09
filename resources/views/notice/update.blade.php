@extends('layouts.app')
@section('title', 'Upate Notice')
@section('content')
<div class="row">
    <div class="col-md-4 ml-auto mr-auto">
        <h2> Update & Resend Notice</h1>


        <form method= "POST" action="{{ route('notice.update', $notice->id ) }}">
            {{ csrf_field() }}
              {{ method_field('PUT') }}
            <div class="form-group">
            <label for="inputTitle">Title</label>
            <input type="text" class="form-control" name ="title" id="inputTitle" aria-describedby="titleHelp"  value="{{$notice->title}}"required>
            @error('title')
            <small id="passwordHelpBlock" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror

            </div>
            <div class="form-group">
              <label for="inputDetails">Details</label><br>
            <textarea name="details" class="form-control" id="inputDetails" cols="43" rows="5" required>{{$notice->details}}</textarea>
            @error('details')
            <small id="inputDetails" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror

            </div>
            <div class="form-group">
              <label for="dueDate">Due Date</label><br>
            <input type="text" id ="dueDate" class="form-control datepicker" name="due_date" value="{{$notice->due_date}}" required readonly></input>
            @error('due_date')
            <small id="dueDate" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror
            </div>


            <h5>Notice to: </h5>
            @foreach($roles as $role)
            @if($role->id == 1)
            <?php continue; ?>
            @else
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="role_id[]" id="inlineRadio1" value="{{$role->id}}"   @if(in_array($role->id, $noticetoroles)) checked @endif >
                  <label class="form-check-label" for="inlineRadio1">{{$role->role}}</label>
              </div>


          @endif
          @endforeach
          @error('role_id')
          <small id="passwordHelpBlock" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror

            <h5 class="mt-3">Send Notification  As:</h5>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="emailNotification" value="Email" name="platform[]" @if(in_array("Email",$noticeplatforms)) checked @endif>
              <label class="form-check-label" for="emailNotification">Email</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="SMSnotification" value="SMS" name="platform[]"  @if(in_array("SMS",$noticeplatforms)) checked @endif>
            <label class="form-check-label" for="SMSnotification">SMS</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="Webnotification" value="Web"  name="platform[]"  @if(in_array("Web",$noticeplatforms)) checked @endif>
            <label class="form-check-label" for="Webnotification">Web</label>
          </div>




          <div class="mt-3">
              <button type="submit" class="btn btn-primary">Resend Notice</button>
          </div>
 </form>
    </div>
</div>
@endsection()

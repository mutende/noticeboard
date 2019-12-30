@extends('layouts.app')
@section('title', 'Create Task')
@section('content')





<div class="row mt-5">
    <div class="col-md-4 ml-auto mr-auto">
      @if ($errors->any())
    <div class="text-danger">
        <ul>
            @foreach ($errors->all() as $error)

                <li> <small class="form-text text-muted text-danger"> {{ $error }} </small></li>
            @endforeach
        </ul>
    </div>
@endif
        <h2> Create Notice</h2>
        <form method= "POST" action="{{ route('notice.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
            <label for="inputTitle">Title</label>
            <input type="text" class="form-control" name ="title" value="{{ old('title') }}" id="inputTitle" aria-describedby="titleHelp" required>
            @error('title')
            <small id="passwordHelpBlock" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror

            </div>
            <div class="form-group">
              <label for="inputDetails">Details</label><br>
            <textarea name="details" class="form-control" id="inputDetails"  cols="43" rows="5" required>{{ old('details') }}</textarea>
            @error('details')
            <small id="inputDetails" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror

            </div>
            <div class="form-group">
              <label for="dueDate">Due Date</label><br>
            <input type="text" id ="dueDate" class="form-control datepicker" name="due_date" value="{{ old('due_date') }}" required readonly></input>
            @error('due_date')
            <small id="dueDate" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror
            </div>


            <h5>Notice to: </h5>
            @foreach($roles as $role)
            @if($role->id == 1 || $role->id == 7)
            <?php continue; ?>
              @else
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="role_id[]" id="inlineRadio1" value="{{$role->id}}">
                  <label class="form-check-label" for="inlineRadio1">{{$role->role}}</label>
              </div>


          @endif
          @endforeach
          @error('role_id')
          <small id="passwordHelpBlock" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror

            <h5 class="mt-3">Send Notification  As:</h5>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="emailNotification" value="Email" name="platform[]">
              <label class="form-check-label" for="emailNotification">Email</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="SMSnotification" value="SMS" name="platform[]">
            <label class="form-check-label" for="SMSnotification">SMS</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="Webnotification" value="Web"  name="platform[]">
            <label class="form-check-label" for="Webnotification">Web</label>
          </div>
          @error('platform')
          <small id="passwordHelpBlock" class="form-text text-muted text-danger">{{ $message }}</small>
            @enderror



          <div class="mt-3">
              <button type="submit" class="btn btn-primary">Send Notice</button>
          </div>
 </form>

    </d>
</div>


@endsection()

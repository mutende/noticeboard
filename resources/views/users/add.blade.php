@extends('layouts.app')
@section('title', 'Add Users')
@section('content')

<div class="row mt-5">

  <div class="col-md-4 mr-4">
    <form method= "POST" action="#">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="inputName">Full Name</label>
        <input type="text" class="form-control" name ="name" id="inputName" aria-describedby="nameHelp" required>
        @error('name')
        <small id="nameHelp" class="form-text text-muted text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputEmail">Email Address</label>
        <input type="text" class="form-control" name ="email" id="inputEmail" aria-describedby="emailHelp" required>
        @error('email')
        <small id="emailHelp" class="form-text text-muted text-danger">{{ $message }}</small>
        @enderror
      </div>

        <h5>Role</h5>

      @foreach($roles as $role)
      @if($role->id == 1)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="hidden" name="role_id" id="inlineRadio1" value="0">
            <!-- <label class="form-check-label" for="inlineRadio1">All Staff</label> -->
        </div>
      @else
      @if($role->id == 7)
      <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role_id" id="inlineRadio1" value="{{$role->id}}" checked>
            <label class="form-check-label" for="inlineRadio1">{{$role->role}}</label>
        </div>
        @else
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role_id" id="inlineRadio1" value="{{$role->id}}">
            <label class="form-check-label" for="inlineRadio1">{{$role->role}}</label>
        </div>
      @endif

    @endif
    @endforeach
    @error('role_id')
    <small id="passwordHelpBlock" class="form-text text-muted text-danger">{{ $message }}</small>
      @enderror



      <div class="mt-3">
          <button type="submit" class="btn btn-primary">Add User</button>
      </div>

    </form>
  </div>
  <div class="col-md-7">
    table
  </div>

</div>


@endsection()

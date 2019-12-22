@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')

<div class="row mt-5">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-header">
        <img class="image image-responsive text-center " src="{{asset('img/user-icon.png')}}" alt="user icon" width="150px" height="150px;" style="border-radius:50%; margin-left: 30%;">

      </div>

      <div class="card-body">
        <form class="" action="{{ route('user.update.profile', $user->id) }}" method="post">
          @csrf
          {{method_field('PUT')}}
          <input type="hidden" name="id" value="{{$user->id}}">
          <h5 class="h5 mt-2">Full Names</h5>
          <input type="text" class="form-control mb-3" name="name" value="{{$user->name}}">

          <h5 class="h5 mt-2">Email Address</h5>
          <input type="text" class="form-control mb-3" name="email" value="{{$user->email}}">

          <h5 class="h5 mt-2">Phonenumber</h5>
          <input type="text" class="form-control mb-3" name="phonenumber" value="{{$user->phonenumber}}">

          <button type="submit" class="btn btn-primary mt-2" name="button">Update Profile</button>

        </form>

      </div>

    </div>

  </div>

</div>

@endsection()

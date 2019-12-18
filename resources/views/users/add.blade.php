@extends('layouts.app')
@section('title', 'Add Users')
@section('content')

<div class="row mt-5">

  <div class="col-md-4 mr-4">
    <form method= "POST" action="{{ route('users.store') }}">
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
      <?php continue; ?>
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

    @if($users->count() < 2)
    <div class="mt-5 text-center">
    <h5>No staff added</h5>

    </div>
    @else

    <table class="table table-sm table-hover">
      <tr>
        <thead class="thead-dark">
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role Group</th>
          <th>Action</th>
        </thead>
      </tr>
      <tbody>
        <?php $count = 1; ?>
        @foreach($users as $user)
        @if($user->role_id == 1)
        <?php continue; ?>
        @endif
        <tr>
          <td><?php echo $count; ?></td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->role->role}}</td>

          <td>
            <form  action="{{ route('user.delete', $user->id )}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            <a onclick="document.getElementById('role{{$user->id}}').style.display='block'" style="color:white;" class="btn btn-primary btn-sm">
                  Update
            </a>

              <button class="btn btn-group-sm btn-sm btn-danger" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        <?php $count++; ?>
        @endforeach
      </tbody>

    </table>
      @endif
  </div>

</div>


@endsection()

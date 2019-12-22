@extends('layouts.app')
@section('title', 'Add Users')
@section('content')

<div class="row mt-5" style="width:120% !important;">
  <div class="col-md-3 mr-2">
    <form method= "POST" action="{{ route('users.store') }}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="inputName">Full Name</label>
        <input type="text" class="form-control" name ="name" id="inputName" aria-describedby="nameHelp" value="{{ old('name') }}" required>
        @error('name')
        <small id="nameHelp" class="form-text text-muted text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputEmail">Email Address</label>
        <input type="text" class="form-control" name ="email" value="{{ old('email') }}" id="inputEmail" aria-describedby="emailHelp" required>
        @error('email')
        <small id="emailHelp" class="form-text text-muted text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="form-group">
        <label for="inputPhone">Phonenumber</label>
        <input type="text" class="form-control" name ="phonenumber" value="{{ old('phonenumber') }}" id="inputPhone" aria-describedby="phoneHelp" required>
        @error('phonenumber')
        <small id="phoneHelp" class="form-text text-muted text-danger">{{ $message }}</small>
        @enderror
      </div>

        <h5>Role</h5>

      @foreach($roles as $role)
      @if($role->id == 1)
        <?php continue; ?>
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
  <div class="col-md-8">

    @if($users->count() < 2)
    <div class="mt-5 text-center">
    <h5>No staff added</h5>

    </div>
    @else

    <table class="table table-sm table-hover table-responsive" id="alltables">

        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role Group</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

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
            <td>{{$user->phonenumber}}</td>
          <td>{{$user->role->role}}</td>
          <td>
            @if($user->status)
            <span class="text-success">Active</span>
            @else
              <span class="text-danger">Suspended</span>
            @endif
          </td>

          <td>
            <form  action="{{ route('user.delete', $user->id )}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            <a onclick="document.getElementById('user{{$user->id}}').style.display='block'" style="color:white;" class="btn btn-primary btn-sm">
                  Update
            </a>

              <button class="btn btn-group-sm btn-sm btn-danger" type="submit">Delete</button>
              @if($user->status)
              <a href="{{ route('user.suspend',$user->id)}}" class="btn btn-warning btn-sm">Suspend</a>
              @endif
            </form>
          </td>
        </tr>
        <?php $count++; ?>

        {{-- edit modal --}}
       <!-- Button trigger modal -->
         <!-- Modal -->
         <div class="w3-container" style="width:100px;">

           <div id="user{{$user->id}}" class="w3-modal">
             <div class="w3-modal-content">
               <div class="w3-container">
                 <span onclick="document.getElementById('user{{$user->id}}').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                 <form  action="{{ route('user.update', $user->id )}}" method="POST">
                   {{ csrf_field() }}
                   {{ method_field('PUT') }}

                    <h5 class="h5 mt-5 mr-5 ml-5">Name:  {{$user->name}}</h5>
                    <h5 class="h5 mt-3 mr-5 ml-5">Email: {{$user->email}}</h5>

                    <h5 class="h5 mt-3 mr-5 ml-5">Role</h5>

                  @foreach($roles as $role)
                  @if($role->id == 1)
                    <?php continue; ?>
                  @else
                  @if($role->id == 7)
                  <?php continue; ?>
                    @else
                    <div class="form-check form-check-inline mr-5 ml-5">
                        <input class="form-check-input" type="radio" name="role_id" id="inlineRadio1" value="{{$role->id}}" @if($user->role_id == $role->id ) checked @endif>
                        <label class="form-check-label" for="inlineRadio1">{{$role->role}}</label>
                    </div>
                  @endif

                @endif
                @endforeach


                  <h5 class="h5 mt-3 mr-5 ml-5">Account Status</h5>
                  @if($user->status)
                  <div class="form-check form-check-inline mr-5 ml-5">
                    <input class="form-check-input" type="radio" name="status" id="statusRadio1" value="1" checked>
                    <label class="form-check-label mr-5 text-success" for="statusRadio1">Active</label>
                    <input class="form-check-input" type="radio" name="status" id="statusRadio2" value="0">
                    <label class="form-check-label" for="statusRadio2">Suspended</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline mr-5 ml-5">
                      <input class="form-check-input" type="radio" name="status" id="statusRadio1" value="1">
                      <label class="form-check-label mr-5" for="statusRadio">Active</label>
                      <input class="form-check-input" type="radio" name="status" id="statusRadio2" value="0" checked>
                      <label class="form-check-label text-danger" for="statusRadio2">Suspended</label>
                  </div>

                  @endif
                  <div class="form-group mt-3">
                      <button type="submit" class="btn btn-primary btn-sm mb-5 mr-5 ml-5" name="button">Update User</button>
                  </div>


                 </form>
               </div>
               </div>
             </div>
           </div>
        @endforeach
      </tbody>

    </table>
      @endif
  </div>

</div>


@endsection()

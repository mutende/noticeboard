@extends('layouts.app')
@section('title', 'Add Roles')
@section('content')

<div class="row mt-5">
  <div class="col-md-4 mr-5">
    @if ($errors->any())
  <div class="text-danger">
      <ul>
          @foreach ($errors->all() as $error)

              <li> <small class="form-text text-muted text-danger"> {{ $error }} </small></li>
          @endforeach
      </ul>
  </div>
@endif
    <form  action="{{ route('roles.store') }}" method="POST">
        {{ csrf_field() }}
      <div class="form-group">
        <label for="inputRole">Role</label>
        <input type="text" class="form-control" name ="role" id="inputRole" aria-describedby="roleHelp" required>
        @error('role')
        <small id="roleHelp" class="form-text text-muted text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="mt-3">
          <button type="submit" class="btn btn-primary">Add Role</button>
      </div>
    </form>
  </div>

  <div class="col-md-6">
    @if ($roles->count() > 0)
      <table class="table table-sm table-hover" id="alltables">

          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Role Group</th>
              <th scope="col">Action</th>
            </tr>

          </thead>

        <?php $count = 1; ?>

        <tbody>
        @foreach ($roles as $role )
        @if($role->id == 1)
        <?php continue; ?>
        @endif
          <tr>
            <td><?php echo $count; ?></td>
            <td>{{ $role->role }}</td>
            <td>
              <form  action="{{ route('role.delete', $role->id )}}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              <a onclick="document.getElementById('role{{$role->id}}').style.display='block'" style="color:white;" class="btn btn-primary btn-sm">
                    Update
              </a>

               </button>
                <button class="btn btn-group-sm btn-sm btn-danger" type="submit">Delete</button>
              </form>

            </td>
          </tr>
          <?php $count++; ?>


          {{-- edit modal --}}
         <!-- Button trigger modal -->
           <!-- Modal -->
           <div class="w3-container" style="width:100px;">


             <div id="role{{$role->id}}" class="w3-modal">
               <div class="w3-modal-content">
                 <div class="w3-container">
                   <span onclick="document.getElementById('role{{$role->id}}').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                   <form  action="{{ route('role.update', $role->id )}}" method="POST">
                     {{ csrf_field() }}
                     {{ method_field('PUT') }}
                      <h5 class="mt-5 mr-5 ml-5 ">Role Group</h5>
                      <input type="text" class="form-control mb-3 mr-5 ml-5" name="role" value="{{$role->role}}" style="width:300px;">
                      <button type="submit" class="btn btn-primary btn-sm mb-5 mr-5 ml-5" name="button">Update Role</button>

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

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
      <table class="table table-sm table-hover">
        <tr>
          <thead class="thead-dark">
            <th scope="col">#</th>
            <th scope="col">Role Name</th>
            <th scope="col">Action</th>
          </thead>
        </tr>
        <?php $count = 1; ?>

        <tbody>
        @foreach ($roles as $role )
          <tr>
            <td><?php echo $count; ?></td>
            <td>{{ $role->role }}</td>
            <td>
              <a href="#" class="btn btn-group-sm btn-primary">Edit</a>
              <button class="btn btn-group-sm btn-danger" type="submit">Delete</button>
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

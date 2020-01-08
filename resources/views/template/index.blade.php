@extends('layouts.app')
@section('title','Notices')
@section('content')
@if($templates->count() < 1 )

<div class="mt-5">
<h5>You have not created any templates</h5>
<a onclick="document.getElementById('createTemplate').style.display='block'" style="color:white;" class="btn btn-primary btn-sm">
      Create Template
</a>
</div>
@else
<div class="mt-5">
  <a onclick="document.getElementById('createTemplate').style.display='block'" style="color:white;" class="btn btn-primary btn-sm">
        Create Template
  </a>
</div>
<div class="row mt-5">
  <table class="table table-sm">
    <tr>
      <thead class="thead-dark">
        <th>#</th>
        <th>Name</th>
        <th>Content</th>
        <th>Action</th>
      </thead>
    </tr>
    <tbody>
      <?php $count = 1; ?>
      @foreach($templates as $temp)
      <tr>
        <td><?php echo $count; ?></td>
        <td>{{$temp->name}}</td>
        <td>{{  \Illuminate\Support\Str::limit($temp->content, 100, $end='...')}}</td>
        <td>

          <form class="" action="{{ route('template.delete',$temp->id)}}" method="post">
            @csrf
            {{ method_field('DELETE') }}

            <button type="button" name="button" class="btn btn-success btn-sm" onclick="document.getElementById('{{$temp->id}}').style.display='block'">Edit</button>
            <button type="submit" name="button" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>


      <div class="w3-container" style="width:100px;">


        <div id="{{$temp->id}}" class="w3-modal">
          <div class="w3-modal-content">
            <div class="w3-container">
              <span onclick="document.getElementById('{{$temp->id}}').style.display='none'" class="w3-button w3-display-topright">&times;</span>

              <form  action="{{ route('template.update', $temp->id) }}" method="POST">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                 <h5 class="mt-5 mr-5">Create Template</h5>
                 <label for="tempName" class="mb-3 mr-5">Template Name</label>
                 <input type="text" id="tempName"class="form-control mb-3 mr-5 " name="name" value="{{ $temp->name }}" style="width:300px;">
                 <label for="summernote" class="mb-3 mr-5">Content</label>
                 <textarea id="summernotes" class="form-control mb-3 mr-5"  rows="8" style="width:70%;" name="content">{{ $temp->content }}</textarea>
                 <button type="submit" class="btn btn-primary btn-sm mt-3 mr-5 mb-3" name="button">Update Template</button>

              </form>
            </div>
            </div>
          </div>
        </div>

      <?php $count++; ?>
      @endforeach
    </tbody>
  </table>

</div>

@endif

<div class="w3-container" style="width:100px;">


  <div id="createTemplate" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('createTemplate').style.display='none'" class="w3-button w3-display-topright">&times;</span>

        <form  action="{{ route('templates.store') }}" method="POST">
          {{ csrf_field() }}

           <h5 class="mt-5 mr-5">Create Template</h5>
           <label for="tempName" class="mb-3 mr-5">Template Name</label>
           <input type="text" id="tempName"class="form-control mb-3 mr-5 " name="name" value="{{ old('name') }}" style="width:300px;">
           <label for="summernote" class="mb-3 mr-5">Content</label>
           <textarea id="summernotes" class="form-control mb-3 mr-5"  rows="8" style="width:70%;" name="content">{{ old('content') }}</textarea>
           <button type="submit" class="btn btn-primary btn-sm mt-3 mr-5 mb-3" name="button">Create Template</button>

        </form>
      </div>
      </div>
    </div>
  </div>

@endsection



{{ Form::label('title', 'Title Notice', ['class' => 'label-control']) }}
{{ Form::text('title', null, ['class' => 'form-control',]) }}

{{ Form::label('details', 'Details', ['class' => 'label-control mt-3']) }}
{{ Form::textarea('details', null, ['class' => 'form-control','rows' => 4, 'cols' => 10]) }}


{{ Form::label('due_date', 'Due date', ['class' => 'label-control mt-3']) }}
{{ Form:: date('due_date', null,  ['class' => 'form-control']) }}

<div class="row justify-content mt-3">
    <div class="col-md-4">
        <button class="btn btn-group-sm btn-block btn-success" type="submit">Update Notice</button>
    </div>
    
</div>


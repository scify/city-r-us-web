<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::formInput('name', 'Όνομα:', $errors, ['class' => 'form-control', 'id' =>
            'name', 'required' => 'true']) !!}
        </div>
        <div class="form-group">
            {!! Form::formInput('description', 'Περιγραφή:', $errors, ['class' => 'form-control', 'type' => 'textarea',
            'size' =>
            '5x5', 'id' => 'description']) !!}
        </div>
        <div class="alert alert-danger" id="errors"></div>
        <div class="form-group text-right">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-success', 'id' => 'saveMission']) !!}
        </div>
    </div>
    </div>


<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::formInput('file', 'Ανέβασμα εικόνας:', $errors, ['class' => 'form-control', 'type' =>'file'])!!}
            <small class="help-blocκ">Το αρχείο δεν πρέπει να ξεπερνά σε μέγεθος τα 10mb.</small>
        </div>
    </div>

    <div class="col-md-9">
        <div class="form-group">
            {!! Form::formInput('name', 'Όνομα:', $errors, ['class' => 'form-control', 'id' =>
            'name', 'required' => 'true']) !!}
        </div>
        <div class="form-group">
            <p>Τύπος αποστολής:</p>
            <label>
                Διαδρομή
                {!! Form::formInput('type', '', $errors, ['class' => 'form-control', 'type' => 'radio', 'value'
                => 'route', 'checked' => 'false']) !!}
            </label>
            <label>
                Καταγραφή σημείου στο χάρτη
                {!! Form::formInput('type', '', $errors, ['class' => 'form-control', 'type' => 'radio', 'value'
                => 'location', 'checked' => 'false']) !!}
            </label>
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




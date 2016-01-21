<div class="row">
<!--    <div class="col-md-3">
        @if (isset($mission) && $mission->img_name)
        <div class="thumbnail">
        <img src="{{ asset('/uploads/missions/'.$mission->img_name) }}"/>
        </div>
        @endif
        <div class="form-group">
            {!! Form::formInput('file', 'Ανέβασμα εικόνας:', $errors, ['class' => 'form-control', 'type' =>'file'])!!}
            <small class="help-blocκ">Το αρχείο δεν πρέπει να ξεπερνά σε μέγεθος τα 10mb.</small>
            @if (isset($mission) && $mission->img_name)
            <br/><small>Η ανεβασμένη εικόνα θα αντικατασταθεί.</small>
            <p><a href="{{ url('missions/'.$mission->id.'/img/remove') }}" class="text-danger">Αφαίρεση εικόνας</a></p>
            @endif
        </div>
    </div>-->

    <div class="col-md-12">
        <div class="form-group">
            {!! Form::formInput('name', 'Όνομα:', $errors, ['class' => 'form-control', 'id' =>
            'name', 'required' => 'true']) !!}
        </div>
        <div class="form-group">
            <p>Τύπος αποστολής *:</p>
            <label>
                Διαδρομή
                @if (isset($mission) && $mission->type->name=='route')
                {!! Form::formInput('mission_type', '', $errors, ['class' => 'form-control', 'type' => 'radio', 'value'
                => 'route', 'checked' => 'true']) !!}
                @else
                {!! Form::formInput('mission_type', '', $errors, ['class' => 'form-control', 'type' => 'radio', 'value'
                => 'route', 'checked' => 'false']) !!}
                @endif
            </label>
            <label>
                Καταγραφή σημείου στο χάρτη
                @if (isset($mission) && $mission->type->name=='location')
                {!! Form::formInput('mission_type', '', $errors, ['class' => 'form-control', 'type' => 'radio', 'value'
                => 'location', 'checked' => 'true']) !!}
                @else
                {!! Form::formInput('mission_type', '', $errors, ['class' => 'form-control', 'type' => 'radio', 'value'
                => 'location', 'checked' => 'false']) !!}
                @endif
            </label>
        </div>
        <div class="form-group">
            {!! Form::formInput('description', 'Περιγραφή:', $errors, ['class' => 'form-control', 'type' => 'textarea',
            'size' => '5x5', 'id' => 'description', 'required' => 'true']) !!}
        </div>
        <div class="alert alert-danger" id="errors"></div>
        <div class="form-group text-right">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-success', 'id' => 'saveMission']) !!}
        </div>
    </div>
</div>




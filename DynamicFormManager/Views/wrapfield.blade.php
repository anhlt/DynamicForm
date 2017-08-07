<div class="form-group @if(isset($errors[0]) && $errors[0]) has-error @endif">
    @if($wrap_label)
        <label class="col-sm-2 control-label" for="{{$id_for_label}}">{{$label}} @if($required)<i
                    class="glyphicon glyphicon-asterisk red"></i>@endif </label>
    @endif
    <div @if($formInline) class="col-sm-10 form-inline text-left" @else class="col-sm-10 text-left" @endif>
        {!! $widget !!}
        @if($remarks)
            <p class="help-block text-left text-muted-help">{!! $remarks !!}</p>
        @endif
        @if($errors)
            @foreach($errors as $error)
                @if($error)
                    <p class="help-block text-left">{{ $error }}</p>
                @endif
            @endforeach
        @endif
    </div>
</div>
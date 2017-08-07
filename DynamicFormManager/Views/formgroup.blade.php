@foreach($formGroup as $group)
    @if(count($group[1]))<h4>{{$group[0]}}</h4>@endif
    @foreach($group[1] as $form)
        {!! $form !!}
    @endforeach
@endforeach
@foreach($widget['attrs'] as $name => $value)@if(isset($value)){{$name}}="{{$value}}"@endif @endforeach


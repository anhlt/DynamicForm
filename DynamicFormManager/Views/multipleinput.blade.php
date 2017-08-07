@foreach($widget['optgroups'] as $group ) @if($group[0]){{$group[0]}}
            @endif @foreach($group[1] as $option)
                    @include($option['templateName'], ['widget'=>$option] )@endforeach @if($group[0])
@endif @endforeach
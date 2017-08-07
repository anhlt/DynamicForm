<select name="{{ $widget["name"] }}" @include('DynamicForm::attrs',['widget' => $widget])>@foreach($widget['optgroups'] as $group ) @if($group[0])
<optgroup label="{{ $group[0]}}">@endif @foreach($group[1] as $option)
    @include($option['templateName'], ['widget'=>$option] )@endforeach @if($group[0])
</optgroup>@endif @endforeach
</select>
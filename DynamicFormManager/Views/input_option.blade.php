@if($wrap_label) <label class="checkbox-inline" @if(isset($widget->attrs['id'])) for="{{ $widget->attrs['id'] }}" @endif> @endif
    @include("DynamicForm::input", ['widget' => $widget]) {{$widget['label']}}
@if($wrap_label) </label>@endif
@extends('app.consumer.baseNotLogin')
@section('mainContent')
    {{$form->setErrors($errors)}}
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <form class="form-horizontal" id="form_update" method="POST">
                    {{csrf_field()}}
                    {!! $form->prefecture->render()!!}
                    {!! $form->city->render()!!}
                    {!! $form->multi_select->render()!!}
                    {!! $form->zip->render()!!}
                    <button type="submit"> submit </button>
                </form>
            </div>
        </div>
    </div>


@endsection
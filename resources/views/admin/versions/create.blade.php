@extends('layouts.app')

@section('title', trans('string.create_version'))

@section('content')
@push('css_stacks')
    <style>
        .error_fonts{
            color: red;
        }
        #divLoading
        {
            display : none;
        }
        #divLoading.show
        {
            display : block;
            position : fixed;
            z-index: 100;
            background-image : url('http://loadinggif.com/images/image-selection/3.gif');
            background-color:#666;
            opacity : 0.4;
            background-repeat : no-repeat;
            background-position : center;
            left : 0;
            bottom : 0;
            right : 0;
            top : 0;
        }
        #loadinggif.show
        {
            left : 50%;
            top : 50%;
            position : absolute;
            z-index : 101;
            width : 32px;
            height : 32px;
            margin-left : -16px;
            margin-top : -16px;
        }
        div.content {
            width : 1000px;
            height : 1000px;
        }
    </style>
@endpush
<div class="row">
    <!-- DOM dataTable -->
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
              
            </header>
            
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <form name="create_version" id='create_version' action="{{ route('version.store')}}" method="post" novalidate>
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('device_type')) has-error @endif">
                                    {!! Form::label('college', trans('string.device_type')) !!}
                                    <select class="form-control" name="device_type" required>
                                        <option hidden disabled selected value>Select Platform</option>
                                    <option value="ios" {{ old('device_type') == 'ios' ? 'selected' : '' }}>{{ trans('string.ios')}}</option>
                                        <option value="android" {{ old('device_type') == 'android' ? 'selected' : '' }}>Android</option>
                                    </select>

                                    @if ($errors->has('device_type'))<span class="help-block">{!!$errors->first('device_type')!!}</span>@endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('version_name')) has-error @endif">
                                    {!! Form::label('version_name', trans('string.version_number')) !!}
                                    {!! Form::text('version_name', null, ['id' =>'version_number','required' => true,'class' => 'form-control', 'placeholder' => trans('string.enter_version_number')]) !!}
                                    @if ($errors->has('version_name'))<span class="help-block">{!!$errors->first('version_name')!!}</span>@endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('force_update')) has-error @endif">
                                    <label class="checkbox-inline"><input type="checkbox" name="force_update" id="force_update" value="1"> {{ trans('string.force_update')}}</label>
                                </div>
                            </div>
                        </div>

                        {{ Form::submit('Save', ['class' => 'btn btn-primary','id' =>'savebtn']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$('body').append('<div id="divLoading"></div>');
 $(document).ready(function () {

     
   $('#savebtn').click(function() {
    $("div#divLoading").addClass('show');
      setTimeout(function(){
        
         document.getElementById('savebtn').disabled = false;
      },100);

    });
 });
    
</script>
@endsection
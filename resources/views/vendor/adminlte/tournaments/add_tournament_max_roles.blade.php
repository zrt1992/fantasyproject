<?php
//dd($tournament_info);

?>

@extends('adminlte::layouts.app')

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add {{$tournament_info['name']}}Roles</h3>
                    </div>
                    <div class="box-body">
                        @include('adminlte::layouts.form_errors')
                        {!! Form::open(['url' => route('postAddmaxRoles',['tournament_id'=>$tournament_info['id']]),'files'=>true]) !!}

                        <div class="form-group">
                            <label>{{$tournament_info['name']}}</label>

                        </div>
                        @foreach($tournament_info['tournament_game']['game_roles'] as $row)
                            <?php
                            $roleMaxLimit = tapArray($tournament_info['tournament_role_max'], ['id' => $row['id']]);
                            if (!empty($roleMaxLimit)) {
                                $roleMaxLimit = $roleMaxLimit['pivot']['max_limit'];
                            }else{
                                $roleMaxLimit = 0;
                            }
                            ?>
                            <div class="form-group">
                                <label>{{$row['name']}}</label>
                                <input required name="player_role_id[{{$row['id']}}][max_limit]"
                                       value="{{$roleMaxLimit}}"
                                       placeholder="{{$row['name']}}" type="text" class="form-control"/>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/datepicker/jquery.datetimepicker.css')}}">
@stop
@section('js')
    <script src="{{asset('/datepicker/jquery.datetimepicker.js')}}"></script>
    <script src="{{asset('/datepicker/jquery.datatimefull.js')}}"></script>
    <script>
        $(document).ready(function ($) {
            var datePickerTheme = 'default';
            var dateFormat = 'd.m.y';
            var timeFormat = 'H:i';
            var timeStep = 15;
            //DateTime picker
            $(".datetimepicker").datetimepicker({
                minDate: '0', //yesterday is minimum date(for today use 0 or -1970/01/01)
                // maxDate: '+1970/01/10',
                //step: timeStep,
                //minTime: 0,
                hours12: false,
                theme: datePickerTheme
            });
        });
    </script>

@stop
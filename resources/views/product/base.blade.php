<?php
$i = '';
$j = '';
?>
@extends('admin.master')
@section('plugins_css')

@endsection
@section('plugins_js')

@endsection

@section('page_js')
    {{--datatable_visibility--}}
@endsection


@section('add_inits')

@stop


@section('page_title_small')

@stop

@section('content')
    @include($partialView)
@stop
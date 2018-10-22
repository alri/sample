@extends('Alri\Test::layout.master-page')

@section('title')
صفحه تست
@endsection

@section('menu')
    @include('Alri\ControlPanel::menu')
@endsection

@section('date')
    @include('Alri\ControlPanel::date')
@endsection

@section('content')

<div>
  ... Package Test . View is Ready
</div>

@endsection

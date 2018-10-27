@extends('Alri\Test::layout.master-page')

@section('title')
  نمایش تستس
@endsection

@section('menu')
    @include('Alri\ControlPanel::menu')
@endsection

@section('date')
    @include('Alri\ControlPanel::date')
@endsection

@section('content')

<h2>test header</h2>
<div>
    test content
</div>

@endsection


@section('script')
	@parent

@endsection



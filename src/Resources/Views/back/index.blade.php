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

<div class="row">
    <div class="cell-md-12">
        <h2>Index View</h2>
    </div>
</div>
@endsection

@section('script')
	@parent

@endsection

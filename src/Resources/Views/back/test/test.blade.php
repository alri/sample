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


<div class="row">
    <div class="cell-md-12" style="font-family:titr">
            ... Package Test . View is Ready
    </div>
</div>

<!-------------------->
<!--Messseges Show  -->
<!-------------------->

<div class="row">
    <!-- show session messages  -->
    <div class="cell-md-12" style="font-family:titr">

        @if(session()->has('TestErrors'))
            <div  class="alert bg-red fg-white" >{{session('CategoryErrors')}}</div>
        @endif

         @if(session()->has('TestUpdate'))
            <div  class="alert bg-green fg-white" >{{session('CategoryUpdate')}}</div>
        @endif

    </div>

    <!-- show vue ajax messeges -->
    <div class="cell-md-12">

      <div v-if="showErrorMessages">
          <div class="alert bg-red fg-white" @click="hideErrorMessages" style="font-family:matn">
              @{{errors[0]}} 
          </div>
      </div>

      <div v-if="showSuccessMessage">
        <div class="alert bg-green fg-white" @click="hideSuccessMessage" style="font-family:matn">
          @{{message}}
        </div>
      </div>
    </div>


    <!-- show jquery ajax messeges -->
    <div class="cell-md12">
        <div  class="success alert bg-green fg-white" ></div>
        <div  class="warning alert bg-red fg-white" ></div>
    </div>

</div>

@endsection


@section('script')
	@parent

@endsection



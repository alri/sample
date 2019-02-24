<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="metro4:init" content="false">

    <link rel="icon" href="../../../../favicon.ico">
      <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!--  CSS -->
    <link href="{{asset('vendor/alri/controlpanel/css/metro-all.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/alri/controlpanel/css/grid.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/alri/controlpanel/css/u-menu.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/alri/controlpanel/css/style.css')}}" rel="stylesheet">

    <!-- JQuery -->
      <script src="{{asset('vendor/alri/controlpanel/js/jquery-3.3.1.min.js')}}"></script>
      <!-- Font Awesome -->
        <script src="{{asset('vendor/alri/controlpanel/js/fontawesome-all.min.js')}}"></script>
  </head>

  <body>
    <div id="app">

    <div class="container">
    	  <div class="row">
            <div class="cell-md-4 border "><a href="{{url("/")}}" target="_blank"><i class="fa fa-home fa-lg"></i></a></div>
            <div class="cell-md-4 border "> @yield('date')</div>
            <div class="cell-md-4 border "><a href="{{route('controlpanel.logout')}}"><i class="fa fa-sign-out-alt fa-lg"></i></a></div>
	      </div>
        <div class="row">
              <div class="cell-md-9 border ">
                   @yield('content')
              </div>
              <div class="cell-md-3 border" >
                   @yield('menu')
              </div>
        </div>

        <div class="row">
              <div class="cell-md-12 border ">Powered By : Alireza Abyari</div>
	      </div>
    </div>

</div>

 @section('script')
    <!--  JQuery
	  Bootstrap
	  Vue
	  Axios
    ================================================== -->
    <script src="{{asset('vendor/alri/controlpanel/js/vmenu.js')}}"></script>
    <script src="{{asset('vendor/alri/controlpanel/js/metro.min.js')}}"></script>
    <script src="{{asset('vendor/alri/controlpanel/js/vue.min.js')}}"></script>
    <script src="{{asset('vendor/alri/controlpanel/js/axios.min.js')}}"></script>

    <script src="{{asset('vendor/alri/test/components/hello-component.js')}}"></script>


    <script>
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".u-vmenu").vmenuModule({
                Speed: 200,
                autostart: false,
                autohide: true
              });
            });
    </script>



  @show



    <script>
        new Vue ({
              el: "#app",
              data(){
                return{
                    message: 'hellow world',
                    model:'',
                    routeName:'',
                    csrfToken:'',
                }
              },
             created:function(){
               //console.log(this.message);
             },
              mounted: function () {
                   Metro.init();
              },
        });
    </script>


  </body>
</html>

@extends('Alri\Management::layout.master-page')

@section('title')
  نمایش دسته ها 
@endsection

@section('menu')
    @include('Alri\ControlPanel::menu')
@endsection

@section('date')
    @include('Alri\ControlPanel::date')
@endsection

@section('content')

@if(!$categorys->isEmpty())

<div class="row">

    <div class="cell-md-3"></div>

    <div class="cell-md-6" style="font-family:matn">

        <div><a href="{{route('block.category.read')}}"><i class="fa fa-sync-alt  fa-lg "></i></a></div>
        <br>

        <div class="success alert bg-green fg-white"></div>
        <div class="warning alert bg-red fg-white"></div>

        <table class="table striped table-border row-hover  compact"  dir="rtl" style="font-family:matn"  >
            <thead>
                <th style="text-align:center">#</th>
                <th style="text-align:center">نام</th>
                <th style="text-align:center">ویرایش</th>
                <th style="text-align:center">حذف</th>
            </thead>

            <tfoot>
                <th style="text-align:center">#</th>
                <th style="text-align:center">نام</th>
                <th style="text-align:center">ویرایش</th>
                <th style="text-align:center">حذف</th>
            </tfoot>

            <tbody class="row-hover">
                @foreach ($categorys as $category)
                <tr id="row{{$category->id}}">
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>

                    <td>
                        <a href="{{route('block.category.update',['id'=>$category->id])}}" target="_blank" title="ویرایش"><i class="fa fa-pencil-alt fa-sm"></i></a>
                    </td>

                    <td>
                        <form class="form1">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="txtId" value="{{$category->id}}">
                            <button  style="font-size: 15px;"><i class="fa fa-trash-alt fa-sm"></i></button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="success alert bg-green fg-white"></div>
        <div class="warning alert bg-red fg-white"></div>

        {{ $categorys->links('Alri\ControlPanel::pagination') }}

    </div>

    <div class="cell-md-3"></div>

</div>
@else

<div class="row">
    <div class="cell-md-12" style="font-family:dastkhat">
        <h2>هیچ دسته بندی موجود نیست</h2>
    </div>
</div>

@endif


@section('script')
	@parent

<script>
      $(".alert").hide()
</script>

<script type="text/javascript">

$(document).ready(function () {

    //#########################
    ///////////// form1
    //#########################
    $('.form1').submit(function (e) {

        var address = "{{route('block.category.delete.submit')}}";
        //var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: address,
            data: $('#form1').serialize(),
          
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    //alert(data.success);
                    $('.success').show();
                    $('.success').append('<i class="fas fa-check "></i>&nbsp;&nbsp;' + data.message + '&nbsp;&nbsp;&nbsp;رکورد شماره' + data.id);

                    //delete html item from table
                    $('#row' + data.id).remove();

                } else {
                    //console.log(data.error);
                    $.each(data.error, function (key, value) {
                        //console.log(value)
                        $('.warning').show();
                        $('.warning').append('<i class="fas fa-exclamation"></i>&nbsp;&nbsp;' + value + '<br>');
                    });
                }
            },

            error: function (data) {
                $('.warning').show();
                $('.warning').html(" ارتباط با سرور ممکن نیست");
                return false;
            }
        });
        return false;
    });

});
</script>

<script>
//--------------------------------
   //hide alert elements
   //--------------------------------
 $(document).ready(function () {

    $(".alert").hide()

        $('.alert').click(function (e) {

            $(".alert").empty();
            $('.alert').hide();

        })
    });

</script>



@endsection


@endsection



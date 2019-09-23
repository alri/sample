@extends('layouts.master-page')

@section('title')
ویرایش پروفایل
@endsection

@section('menu')
    @include('Alri\Ecommerce::front.menu')
@endsection


@section('content')
<div class="row">
    <div class="col-2 bg-light"></div>
    <div class="col-8  bg-light">
    
        <form id="form1" method="post" action="" >
            
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="{{$user->id}}">
            {{csrf_field()}}

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label>تلفن</label>
                        <input  type="text" name="tell" id="tell" value="@if(null !== (old('tell'))){{old('tell')}}@else{{$user->tell}}@endif"  class="form-control"  placeholder="کدشهر و تلفن" >
                        <div id="tellError" class="alert text-danger"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>موبایل</label>
                        <input type="text" name="mobile" id="mobile" value="@if(null !== (old('mobile'))){{old('mobile')}}@else{{$user->mobile}}@endif" class="form-control" placeholder="شماره به همراه صفر اول">
                        <div id="mobileError" class="alert text-danger"></div>
                    </div>   
                </div>
            </div>
            
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">ویرایش اطلاعات</button>
                    </div>
                </div>
            </div>

             <div class="form-row">
                <div class="col">
                    <div  class="success alert alert-success" role="alert"></div>
                </div>
            </div>
            
        </form>

    </div>
    <div class="col-2 bg-light"></div>
</div>

@endsection

@section('script')
    @parent

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

    <script>

        $(function() {
            $("#form1").validate({
                rules:{
                    tell:{
                        required: true,
                        minlength:6,
                        maxlength:11,
                        regex:"^[0][0-9]{4,10}$",
                    },
                    mobile:{
                        required:true,
                        maxlength:11,
                        regex:"^[0][9][0-9]{9}$",
                    },
                },
                messages:{
                    tell:{
                        regex:"الگوی وارد شده صحیح نمیباشد",
                    },
                    mobile:{
                        regex:"الگوی وارد شده صحیح نمیباشد",
                    },
                },
                errorClass: "text-danger",
                errorElement: "span",
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                submitHandler: function(form,e) {
                    e.preventDefault();
                    //console.log('Form submitted');
                    var address = "{{route('user.profile.update.submit')}}";
                    //var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: address,
                    data: $('#form1').serialize(),
                   
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            //alert(data.success);
                            $('.success').show();
                            $('.success').append('<i class="fas fa-check "></i>&nbsp;&nbsp;' + data.message + '&nbsp;&nbsp;&nbsp;');

                            //delete html item from table
                            $('#row' + data.id).remove();

                        } else {
                            //console.log(data.error);
                            $.each(data.error, function (key, value) {
                                //console.log(value)
                                $('.warning').show();
                                $('.warning').append('<i class="fas fa-arrow-left"></i>&nbsp;&nbsp;' + value + '<br>');
                            });
                        }
                    },

                    error: function (xhr, status, error) {

                        if (xhr.status == "422") {
                            data = $.parseJSON(xhr.responseText);

                            //------or------ for field validation and show error
                            if (data.errors.postcode1) {
                                $('#tellError').show();
                                $('#tellError').html(data.errors.tell[0]);
                            }
                            if (data.errors.address2) {
                                $('#mobileError').show();
                                $('#mobileError').html(data.errors.tell[0]);
                            }
                         
                        } else {
                            $('#error').show();
                            $('#error').html('<div class="alert bg-red fg-white">ارتباط با سرور برقرار نیست</div>');
                        }

                        return false;
                    },

                });
                return false;
                }
            });
        });

    </script>
@endsection
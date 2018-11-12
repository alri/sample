<?php

namespace Alri\Test\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

use Alri\Test\Models\Test as Test;

class HomeController extends Controller
{

    public function __construct()
    {
        //
    }

    public function showTestForm()
    {
      return view('Alri\Test::back.home.index');
    }

    public function testInsert(Request $request)
    {
        //------------------------------------------
        //----------- Ajax or Http
        //-------------------------------------------

        //----------- Form Request Validation

        //------------------------------------------
        //----------- Handly Validation
        //-------------------------------------------
        $rules= [
          'txtName'=>'required',
          'txtFamily'=>'required',
        ];

        $errorMessage=  [
          'txtName.required'=>'پر کردن فیلد نام الزامی است',
          'txtFamily.required'=>'پر کردن فیلد رمز عبور الزامی است',
        ];

        Validator::make($request->all(),$rules,$customMessages)->validate();


        //---------------------------------------
        //------------ Get & Set Data
        //---------------------------------------

        
        //--------------------------------------
        //-------------  Server Side Validation With DB
        //--------------------------------------
        /*
        $errors=array();
        array_push($errors,"این رکورد قبلا ایجاد شده است");
        if(!empty($errors))
        {
          //--- send ajax json & http response
          if ($request->ajax() || $request->wantsJson())
         {
             $data=[
                 'type'=>'error',
                 'message'=>'request is fail',
                 'status'=>422
                 'errors'=>$errors,
             ]
              return response()->json($data,422);
         }else
          {
              $request->session()->flash('MySessionErrors',$errors);
              return redirect()->route('Alri\Test::back.home.create');
          }
          
        }
        */

        //--------------------------------------
        //-------------  Work Wirh Database & Models
        //--------------------------------------


        //-----------------------------------------
        //-------------  Send Notification
        //-----------------------------------------


        //----------------------------------------
        //----------- Ajax Json & Http Response
        //----------------------------------------

        if ($request->ajax() || $request->wantsJson())
        {
            $data=[
                'type'=>'success',
                'message'=>'عملیات با موفقیت انجام شد',
                'status'=>200,
                'user'=>$user,
            ];
            return response()->json($data,200);
        }else{
            //------------------------------
            $data=['success'=>'عملیات با موفقیت انجام شد'];
            $request->session()->flash('Message','کار مورد نظر انجام شد');
            return redirect()->route('test.home.index',$data);
        }

        
    }

    public function dbCheck()
    {
      $test=Test::find(1);
       echo($test->id."-");
       echo($test->name);
       echo("<br>"."Model is Work");
    }

    public function testFasade()
    {
      echo('Test Fasade is Done !!!');
    }
}

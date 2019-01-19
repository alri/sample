<?php

namespace Alri\Sample\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

use Alri\Sample\Models\Test as Test;

class SampleController extends Controller
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
                 'status'=>422,
                 'errors'=>$errors,
             ];
              return response()->json($data,422);
         }else
          {
              $request->session()->flash('TestErrors',$errors);
              return redirect()->route('test.create.routeName');
          }
          
        }

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

    public function showCreateForm()
    {
      return view('Alri\Management::back.admin.create');
    }


    //Example

    public function create(AdminRequest $request)
    {
              //-----------------------------
             //----------- Get & Set  value
             //------------------------------
             $name=$request->input('txtName');
             $username=$request->input('txtUserName');
        

             //-----------------------------------------
             //-------------  Work With Database
             //-----------------------------------------

            $admin= new Admin();
               $admin->name=$name;
               $admin->username=$username;
            $admin->save();

             //-----------------------------
            //----------- Redirect To View With Session Message
            //------------------------------
             $request->session()->flash('AdminCreate','ادمین جدید به درستی اضافه شد');
             return redirect()->route('management.admin.create');
    }

    public function read()
    {
      $admins=Admin::paginate(10);
      $data=['admins'=>$admins];
      return view('Alri\Management::back.admin.read',$data);
    }

    public function disable(Request $request)
    {
        if ($request->ajax() || $request->wantsJson())
       {

         //------ get data
         $id=$request->input('txtId');
         $status=$request->input('txtStatus');

         //------ work with DB
         Admin::where('id','=',$id)->update(['status'=>$status]);

         //------ return JSON Object Response
        return response()->json(['success'=>'عملیات به درستی انجام شد','id'=>$id]);
       }
    }
}

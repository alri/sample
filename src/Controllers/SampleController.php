<?php

namespace Alri\Sample\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

use Alri\Sample\Models\Test as Test;

class SampleController extends Controller
{

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

   //-----------------------------
   //--------- Sample Category CURD
   //------------------------------
   public function __construct()
    {
        //
    }

    public function showCreateForm()
    {
        return view('Alri\Block::back.category.create');
    }

    public function create(CategoryRequest $request)
    {
        // validation is ok

        //-----------------------------
        //----------- Get & Set  value
        //------------------------------
        $name=$request->input('txtName');

        //-----------------------------------------
        //-------------  Work With Database
        //-----------------------------------------
        $category=new Category();
            $category->name=$name;
        $category->save();

        //-----------------------------
        //----------- Redirect To View With Session Message
        //------------------------------
        $request->session()->flash('BlockCategoryCreate','دسته بندی به درستی ایجاد شد');
        return redirect()->route('block.category.create');
    }

    public function read()
    {
      $categorys=Category::paginate(10);
      $data=['categorys'=>$categorys];
      return view('Alri\Block::back.category.read',$data);
    }

    public function showUpdateForm($id)
    {
        $category=Category::find($id);
        if(isset($category))
        {
            $data=['category'=>$category];
            return view('Alri\Block::back.category.update',$data);
        }else 
        {
            abort(404);
        }
    }

    public function update(CategoryRequest $request)
    {
       // validation is ok

        //-----------------------------
        //----------- Get & Set  value
        //------------------------------
        $name=$request->input('txtNameUpdate');
        $id=$request->input('txtId');
        //-----------------------------------------
        //-------------  Work With Database
        //-----------------------------------------
        $category=Category::find($id);
            $category->name=$name;
        $category->save();

        //-----------------------------
        //----------- Redirect To View With Session Message
        //------------------------------
        $request->session()->flash('BlockCategoryUpdate','دسته بندی به درستی ویرایش شد');
        return redirect()->route('block.category.update',['id'=>$id]);
    }

    public function delete(Request $request)
    {
        if ($request->ajax() || $request->wantsJson())
       {

         //------ get data
         $id=$request->input('txtId');

         //------ work with DB
        $category=Category::find($id);
        $category->delete();

         //------ return JSON Object Response
         $data=[
            'type'=>'success',
            'message'=>'عملیات با موفقیت انجام شد',
            'status'=>200,
            'id'=>$id,
        ];
        return response()->json($data,200);
       }
    }

}

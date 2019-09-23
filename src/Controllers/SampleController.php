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
        //----------- Handly Validation for http & ajax
        //-------------------------------------------
        $rules= [
          'txtName'=>'required',
          'txtFamily'=>'required',
        ];

        $errorMessage=  [
          'txtName.required'=>'پر کردن فیلد نام الزامی است',
          'txtFamily.required'=>'پر کردن فیلد رمز عبور الزامی است',
        ];

        Validator::make($request->all(),$rules,$errorMessages)->validate();


        //---------------------------------------
        //------------ Get & Set Data
        //---------------------------------------

        
        //--------------------------------------
        //-------------  Server Side Validation With DB
        //--------------------------------------
        foreach($orderItems as $item)
        {
            
        }
        $error="";
       
        if(!empty($error))
        {
          //--- send ajax json & http response
          if ($request->ajax() || $request->wantsJson())
         {
             $data=[
                 'type'=>'error',
                 'message'=>'request is fail',
                 'status'=>422,
                 'error'=>$error,
             ];
              return response()->json($data,200);
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
   //--------- Sample Content CURD
   //------------------------------
   public function __construct()
    {
        //
    }

    public function showCreateForm()
    {
        $categorys=Category::get();
        $data=['categorys'=>$categorys];
        return view('Alri\Block::back.content.create',$data);
    }

    public function create(ContentRequest $request)
    {
        // validation is ok

        //-----------------------------
        //----------- Get & Set  value
        //------------------------------
        $categoryId=$request->input('txtCategory');
        $title=$request->input('txtTitle');
        $content=$request->input('txtContent');
        $status="غیرفعال";

        //-----------------------------------------
        //-------------  Work With Database
        //-----------------------------------------
        //----or
        $record= new Content([
            'title'=>$title,
            'status'=>$status,
            'content'=>$content,
        ]);

        $category=Category::find($categoryId);
        $category->content()->save($record);

        /* ----or
        $record= new Content(
            $record->category_id=$categoryId;
            $record->title=$title;
            $record->status=$status;
            $record->content=$content;
        $record->save();
        */

        //-----------------------------
        //----------- Redirect To View With Session Message
        //------------------------------
        $request->session()->flash('BlockContentCreate','محتوا به درستی ایجاد شد');
        return redirect()->route('block.content.create');
        
    }


    public function read()
    {
      $contents=Content::paginate(10);
      $data=['contents'=>$contents];
      return view('Alri\Block::back.content.read',$data);
    }


    public function enable(Request $request)
    {
        if ($request->ajax() || $request->wantsJson())
       {

         //------ get data
         $id=$request->input('txtId');
         $status=$request->input('txtStatus');

         //------ work with DB
         Content::where('id','=',$id)->update(['status'=>$status]);

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


    public function showUpdateForm($id)
    {
        $content=Content::find($id);
        if(isset($content))
        {
            $data=['content'=>$content];
            return view('Alri\Block::back.content.update',$data);
        }else 
        {
            abort(404);
        }
    }

    public function update(ContentRequest $request)
    {
       // validation is ok

        //-----------------------------
        //----------- Get & Set  value
        //------------------------------
        $title=$request->input('txtTitleUpdate');
        $id=$request->input('txtId');
        $content=$request->input('txtContent');
     
        //-----------------------------------------
        //-------------  Work With Database
        //-----------------------------------------
        $record=Content::find($id);
            $record->title=$title;
            $record->content=$content;
        $record->save();

        //-----------------------------
        //----------- Redirect To View With Session Message
        //------------------------------
        $request->session()->flash('BlockContentUpdate','دسته بندی به درستی ویرایش شد');
        return redirect()->route('block.content.update',['id'=>$id]);
    }



    public function delete(Request $request)
    {
        if ($request->ajax() || $request->wantsJson())
       {

            //------ get data
             $id=$request->input('txtId');

            //------ work with DB
            $content=Content::find($id);
            $content->delete();

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

<?php

namespace Alri\Test\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alri\ControlPanel\Lib\AlriAuth as Auth;
use Alri\Management\Models\Admin;

use \Firebase\JWT\JWT;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function getFunc()
     {

         //-- state 1 : model
         $admins=Admin::get();

         //-- or 1 --> 1==2
         $data=$admins->toArray();

         //-- or 2 --> 1==2
         $data=array('admins'=>$admins);

         return response()->json($data);


         //--------------- state 2 : create array
          //--or 1 --> 1==2
         $items=[
           'name' => 'Abigail',
           'state' => 'CA'
          ];

          //-- or 2 --> 1==2
          $items=array(
            'name' => 'Abigail',
            'state' => 'CA'
          );

          //---------------------------- send data with structure
          $data=[
            'code'=>200,
            'status'=>'success',
            'items'=>$items,
          ];

          return response()->json($data);

     }

     public function postFunc(Request $request)
     {

           $username=$request->get('username');
           $password=$request->get('password');

           $items=array(
             'username'=>$username,
             'password'=>$password,
           );

           //---------------------------- send data with structure
           $data=[
             'code'=>200,
             'status'=>'success',
             'items'=>$items,
           ];

             return response()->json($data);

     }


     public function read(Request $request)
     {

      // get id and username from client
      $adminInfo=$request->get('adminInfo');
      echo($adminInfo['id']);

              //-- get data from Model
              $admins=Admin::get();
              $data=$admins->toArray();

                  $result = array(
                    'code' => 200,
                    'status' => 'success',
                    'items' => $data,
                  );

            return response()->json($result);

     }

}

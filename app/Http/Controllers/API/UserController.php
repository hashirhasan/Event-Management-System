<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{


public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

         if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
           $user= Auth::user();

            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leadername' => 'required',
            'domain'=>'required',
            'organisation'=>'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
$input = $request->all();
           $input['leader_name']=$input['leadername'];
        $input['domain_name']=$input['domain'];
        $input['password'] = bcrypt($input['password']);
        $input['verified']=User::UNVERIFIED_USER;
        $input['verificationtoken']=User::getverificationtoken();
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['id'] =  $user->id;
return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        unset($user['created_at'],$user['updated_at'],$user['email_verified_at']);
        return response()->json(['success' => $user,'link'=>route('details.update',$user-> id)],200);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id) ;
        if($user->id==auth::user()->id)
       {
           $data=$request->all();
        //    if(isset($data['email']))
        //    {
        //        $data['status']="u r not authorised to change the email";
        //    }
        $data['email']=$user->email;

           $user->update($data);
           return response()->json(['success' => $user]);
       }
       else{
           return "u r not authorised";
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}

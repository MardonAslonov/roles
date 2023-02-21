<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{


    public function index()
    {
    return   User::limit(10)->get();
    }


    public function show(Request $request)
    {
        return  User::where('id',$request->id)->first();
    }


    public function   create(Request $request)
    {

        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->role_id=$request->role_id;
        $user->save();
       return 'User created successfully';

    }

    // public function update(Request $request)
    // {

    //    $user = User::findOrFail($request->id);
    //    if(!is_null($request->name)) $user->name=$request->name;
    //    if($request->role_id!=null)  $user->role_id=$request->role_id;
    //    if($request->email!=null) $user->email=$request->email;
    //    if($request->phone!=null) $user->phone=$request->phone;
    //    if(!is_null($request->sinior_id)) $user->sinior_id=$request->sinior_id;
    //    if(!is_null($request->skilad_id)) $user->skilad_id=$request->skilad_id;
    //    if($request->password!=null) $user->password=bcrypt($request->password);
    //    $user->save();
    //    return $user;

    // }

    public function  delete(Request $request)
    {
        $user =User::findOrFail($request->id);
        $user->delete();
        return 'User deleted';
    }

}

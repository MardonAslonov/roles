<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
// use Doctrine\DBAL\Query\QueryException;
class UserController extends Controller
{


    public function index(Request $request)
    {
        return User::paginate($request->per_page);
    }


    public function show(Request $request)
    {
        return User::where('id', $request->id)->first();
    }

    public function create(UserCreateRequest $request)
    {

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = $request->input('role_id');
        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json(
                ['error' =>
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            );
        }
        return response()->json(["success"=>"ok"]);

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

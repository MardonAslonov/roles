<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
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

    public function create(Request $request)
    {

        // return ($request->all());

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
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

    public function update(UserUpdateRequest $request)
    {

       $user = User::findOrFail($request->id);
       if(!is_null($request->name)) $user->name=$request->name;
       if(!is_null($request->role_id)) $user->role_id=$request->role_id;
       if(!is_null($request->email)) $user->email=$request->email;
    //    if(!is_null($request->phone)) $user->phone=$request->phone;
    //    if(!is_null($request->sinior_id)) $user->sinior_id=$request->sinior_id;
    //    if(!is_null($request->skilad_id)) $user->skilad_id=$request->skilad_id;
       if(!is_null($request->password)) $user->password=bcrypt($request->password);
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

    public function delete(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->delete();
        return response()->json(["success"=>"ok"]);

    }
}

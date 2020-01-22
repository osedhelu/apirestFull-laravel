<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(["ok" => "true", "data" => $users], 200);
    }

    
    public function store(Request $request)
    {
            $rules = [
                'name' =>'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ];
            $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::disable;
        $data['verification_token'] = User::generateToken();
        $data['role'] = User::userRegular;
        $userAdd = User::create($data);
        return response()->json(['ok' => 'true', 'data' => $userAdd]);  
        
    }

    public function show($id)
    {
        $user = User::findOrfail($id);
        return response()->json(['data' => $user], 200);
    }

   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'email'=>'email|unique:users,email,'.$user->id,
            'password'=>'min:6|confirmed',
            'role'=> 'in:'.User::userAdmin.','.User::userRegular 
        ]);
        if($request->has('name')) {
            $user->name = $request->name;
        }
        if($request->has('email') && $user->email != $request->email){
            $user->verified = User::disable;
            $user->verification_token = User::generateToken();
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        if($request->has('role')){
            if(!$user->verifiedFn()){
                return response()->json(['error' => 'solo los usuarios verificados puedes cambiar su rol'], 409);
            }
            $user->role = $request->role;

        }
        if(!$user->isDirty()) {
            return response()->json(['error'=> 'para actualizar debes tener mas de 2 valores para cambiar']);
        }
        $user->save();
        return response()->json(['data'=> $user], 200);
    }


    public function destroy($id)
    {
        //
    }
}

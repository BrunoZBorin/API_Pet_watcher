<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
            $address = \Correios::cep($request->zipcode);

            $user = new User();
            $user->fill($request->all());
            $user->password = Hash::make($user->password);
            if(!empty($address)) {
                $user->address = $address['logradouro'];
                $user->neighborhood = $address['bairro'];
                $user->city = $address['cidade'];
                $user->state = $address['uf'];
            }
            $user->save();
            return response()->json($user, 201);
        
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([], 200);
    }
}

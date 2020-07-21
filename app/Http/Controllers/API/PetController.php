<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Pet;

use App\User;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        return response()->json($pets, 200);
    }

    public function store(Request $request)
    {
        
            $pet = Pet::create($request->all());
            return response()->json($pet, 200);
        
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        $user = User::findOrFail($pet->user_id);
        return response()->json([$pet, $user->name], 200);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->fill($request->all());
        $pet->save();
        return response()->json($pet, 200);
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return response()->json([], 200);
    }
}

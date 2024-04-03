<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function display()
    {
        $users = User::get();
        // dd($users);
        return response()->json($users, 200);
    }
    public function CreateUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);


        $user = User::create($validatedData);

        if (!$user) {
            return response()->json(['message' => 'Creation of user failed'], 404);
        } else {
            return response()->json(['message' => 'Success', 'user' => $user], 201);
        }
    }



public function DeleteUser($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
}

public function modify(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'required',
    ]);

    $data = User::find($id);

    if (!$data) {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }

    $data->name = $validatedData['name'];
    $data->email = $validatedData['email'];
    $data->password = bcrypt($validatedData['password']);
    $data->save();

    return response()->json(['message' => 'Modification effectuée avec succès'], 200);
}




}


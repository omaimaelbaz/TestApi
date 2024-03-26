<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

       $category = Categories::all();


        return response()->json($category);
    }

    public function create(Request $request)
    {
        $category = Categories::create([
            'name' => $request->input('name'),
        ]);

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Categories::find($id);

        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée.'], 404);
        }

        $category->update([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'La catégorie a été mise à jour avec succès.',
            'category' => $category
        ]);
    }
    public function delete($id)
    {
        $category = Categories::find($id);
        $category->delete();
        $res = [
            "message"=> 'u have deleted success',
            "status"=>200,
            "data" =>$category
        ];
        return response()->json($res);
    }

    }


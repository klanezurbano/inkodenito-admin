<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function store (Request $request) {
        $imagePath = $request->file('image')->store('public/recipes');

        $recipe = Recipe::create([
            'title' => $request->title,
            'image_url' => $imagePath,
            'description' => $request->description,
            'prep_time' => $request->prep_time,
            'cooking_time' => $request->cooking_time,
            'serving_size' => $request->serving_size,
            'user_id' => $request->user()->id,
            'category_ids' => json_encode($request->category_ids)
        ]);

        return response()->json([
            'recipe' => $recipe
        ]);
    }

    public function getRecipeAuthor($recipe_id) {
        $recipe = Recipe::find($recipe_id);

        return response()->json([
            'user' => $recipe->user
        ]);
    }
}

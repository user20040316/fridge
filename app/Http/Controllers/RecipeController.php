<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ingredient;

class RecipeController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::where('user_id', auth()->id())->pluck('name')->toArray();

        if (empty($ingredients)) {
            return view('recipes.index', ['recipes' => [], 'message' => '食材が登録されていません。']);
        }

        $query = implode(',', $ingredients);

        $response = Http::get('https://api.spoonacular.com/recipes/findByIngredients', [
            'ingredients' => $query,
            'number' => 5, // 5件だけ取得
            'apiKey' => env('SPOONACULAR_API_KEY'),
        ]);

        $recipes = $response->json();

        return view('recipes.index', [
            'recipes' => $recipes,
            'message' => null,
        ]);
    }
}

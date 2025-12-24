<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::where('user_id', Auth::id())->get();
        return view('ingredients.index', compact('ingredients'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string|max:50', // ← 追加
            'expiration_date' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')->with('success', '食材を追加しました！');
    }
    
    public function edit(Ingredient $ingredient)
    {
        // 自分の食材だけ編集できるようにする（セキュリティ対策）
        if ($ingredient->user_id !== auth()->id()) {
            abort(403);
        }

        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        if ($ingredient->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string|max:50',
            'expiration_date' => 'nullable|date',
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.index')->with('success', '食材を更新しました！');
    }



    public function destroy(Ingredient $ingredient)
    {
        if ($ingredient->user_id !== Auth::id()) {
            abort(403);
        }

        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', '削除しました。');
    }
}

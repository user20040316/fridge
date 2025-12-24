<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('おすすめレシピ') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            @if ($message)
                <p>{{ $message }}</p>
            @else
                <h3 class="text-lg font-semibold mb-4">冷蔵庫の食材からおすすめ</h3>
                <ul class="space-y-4">
                    @foreach ($recipes as $recipe)
                        <li class="border p-4 rounded flex gap-4 items-center">
                            <img src="{{ $recipe['image'] }}" alt="{{ $recipe['title'] }}" class="w-24 h-24 object-cover rounded">
                            <div>
                                <p class="font-semibold">{{ $recipe['title'] }}</p>
                                <a href="https://spoonacular.com/recipes/{{ Str::slug($recipe['title']) }}-{{ $recipe['id'] }}" target="_blank" class="text-blue-500 underline">レシピを見る</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="flex justify-end mb-4">
    <a href="{{ route('ingredients.index') }}"
       class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
        戻る
    </a>
</div>
    </div>
</x-app-layout>

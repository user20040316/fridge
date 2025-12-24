<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('冷蔵庫の中身') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form method="POST" action="{{ route('ingredients.store') }}" class="mb-6">
                @csrf
                <div class="flex gap-3">
                    <input type="text" name="name" placeholder="食材名" class="border p-2 rounded w-1/3" required>
                    <input type="number" name="quantity" placeholder="数量" class="border p-2 rounded w-1/5" min="1" required>
                    <select name="unit" class="border p-2 rounded w-1/5">
                        <option value="個">個</option>
                        <option value="本">本</option>
                        <option value="袋">袋</option>
                        <option value="g">g</option>
                        <option value="ml">ml</option>
                        <option value="枚">枚</option>
                        <option value="">(なし)</option>
                    </select>
                    <input type="date" name="expiration_date" class="border p-2 rounded w-1/4">
                    <button type="submit" class="px-4 py-2 border rounded w-[80px]">追加</button>
                </div>

            </form>

            <table class="w-full text-left border-t border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-center ">
                        <th class="py-2 px-3">食材名</th>
                        <th class="py-2 px-3">数量</th>
                        <th class="py-2 px-3">単位</th> <!-- 追加 -->
                        <th class="py-2 px-3">賞味期限</th>
                        <th class="py-2 px-3">編集・削除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr class="text-center">
                            <td class="py-2 px-3">{{ $ingredient->name }}</td>
                            <td class="py-2 px-3">{{ $ingredient->quantity }}</td>
                            <td class="py-2 px-3">{{ $ingredient->unit ?? '-' }}</td> <!-- 追加 -->
                            <td class="py-2 px-3">{{ $ingredient->expiration_date ?? '-' }}</td>
                            <td class="py-2 px-3 flex justify-center gap-2">
                                <a href="{{ route('ingredients.edit', $ingredient) }}" class="text-blue-500 px-2 border">編集</a>
                                <form method="POST" action="{{ route('ingredients.destroy', $ingredient) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-700 px-2 border">削除</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mb-4">
    <a href="{{ route('recipes.index') }}"
       class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
        レシピ一覧へ
    </a>
</div>
    </div>
</x-app-layout>

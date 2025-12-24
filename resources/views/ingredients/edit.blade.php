<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            食材を編集
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form method="POST" action="{{ route('ingredients.update', $ingredient) }}">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-4">
                    <div>
                        <label class="block text-sm font-medium">食材名</label>
                        <input type="text" name="name" value="{{ old('name', $ingredient->name) }}" class="border p-2 rounded w-full" required>
                    </div>

                    <div class="flex gap-3">
                        <div class="w-1/3">
                            <label class="block text-sm font-medium">数量</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $ingredient->quantity) }}" class="border p-2 rounded w-full" min="1" required>
                        </div>
                        <div class="w-1/3">
                            <label class="block text-sm font-medium">単位</label>
                            <select name="unit" class="border p-2 rounded w-full">
                                <option value="個" @selected($ingredient->unit === '個')>個</option>
                                <option value="本" @selected($ingredient->unit === '本')>本</option>
                                <option value="袋" @selected($ingredient->unit === '袋')>袋</option>
                                <option value="g" @selected($ingredient->unit === 'g')>g</option>
                                <option value="ml" @selected($ingredient->unit === 'ml')>ml</option>
                                <option value="枚" @selected($ingredient->unit === '枚')>枚</option>
                                <option value="" @selected($ingredient->unit === null)>(なし)</option>
                            </select>
                        </div>
                        <div class="w-1/3">
                            <label class="block text-sm font-medium">賞味期限</label>
                            <input type="date" name="expiration_date" value="{{ old('expiration_date', $ingredient->expiration_date) }}" class="border p-2 rounded w-full">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('ingredients.index') }}" class="px-4 py-2 border rounded">戻る</a>
                        <button type="submit" class="px-4 py-2 border rounded">更新</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

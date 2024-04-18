<form method="POST">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">New ad</h2>

    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
        <input type="text" id="title" name="title" required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
        <input type="text" id="image" name="image" required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price (€)</label>
        <input type="number" id="price" name="price" required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
        <input type="text" id="location" name="location" required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="transaction" class="block text-gray-700 text-sm font-bold mb-2">Transaction type</label>
        <select id="transaction" name="transaction" required
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option selected disabled>-- select type --</option>
            <option value="rent">Rent</option>
            <option value="sale">Sale</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <textarea id="description" name="description" rows="7" required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>

    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Ajouter
        </button>
    </div>
</form>

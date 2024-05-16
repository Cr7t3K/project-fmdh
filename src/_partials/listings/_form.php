<form method="POST" enctype="multipart/form-data">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        <?php if(strpos($_SERVER['REQUEST_URI'],'new.php')): ?>
            New Add
        <?php else: ?>
            Update <?= !isset($property) ? '' : $property['title'] ?>
        <?php endif; ?>
    </h2>

    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
        <input type="text" id="title" name="title" value="<?= !isset($property) ? '' : $property['title'] ?>"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <?php if (!empty($errors['title'])): ?>
            <p class="text-red-500 text-xs italic"><?= $errors['title']; ?></p>
        <?php endif; ?>
    </div>
    <div class="mb-4">
        <label for="property_type" class="block text-gray-700 text-sm font-bold mb-2">Property type</label>
        <select id="property_type" name="property_type"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option <?= isset($property) ? '' : "selected" ?> disabled>-- select type --</option>
            <option <?= isset($property) && $property['type'] === "house" ? "selected" : '' ?> value="house">House</option>
            <option <?= isset($property) && $property['type'] === "apartment" ? "selected" : '' ?> value="apartment">Apartment</option>
        </select>
        <?php if (!empty($errors['property_type'])): ?>
            <p class="text-red-500 text-xs italic"><?= $errors['property_type']; ?></p>
        <?php endif; ?>
    </div>
    <div class="mb-4">
        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
        <?php if(isset($property)): ?>
            <img src="<?= $property['img'] ?>" alt="<?= $property['title'] ?>" class="mb-2">
        <?php endif; ?>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg"
               class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        <?php if (!empty($errors['image'])): ?>
            <?php foreach($errors['image'] as $error): ?>
                <p class="text-red-500 text-xs italic"><?= $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price (€)</label>
        <input type="number" id="price" name="price" value="<?= !isset($property) ? '' : $property['price'] ?>"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <?php if (!empty($errors['price'])): ?>
            <p class="text-red-500 text-xs italic"><?= $errors['price']; ?></p>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
        <input type="text" id="location" name="location" value="<?= !isset($property) ? '' : $property['city'] ?>"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <?php if (!empty($errors['location'])): ?>
            <p class="text-red-500 text-xs italic"><?= $errors['location']; ?></p>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label for="transaction" class="block text-gray-700 text-sm font-bold mb-2">Transaction type</label>
        <select id="transaction" name="transaction"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option <?= isset($property) ? '' : "selected" ?> disabled>-- select type --</option>
            <option <?= isset($property) && $property['transaction'] === "rent" ? "selected" : '' ?> value="rent">Rent</option>
            <option <?= isset($property) && $property['transaction'] === "sale" ? "selected" : '' ?> value="sale">Sale</option>
        </select>
        <?php if (!empty($errors['transaction'])): ?>
            <p class="text-red-500 text-xs italic"><?= $errors['transaction']; ?></p>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <textarea id="description" name="description" rows="7"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        ><?= !isset($property) ? '' : $property['description'] ?></textarea>

        <?php if (!empty($errors['description'])): ?>
            <p class="text-red-500 text-xs italic"><?= $errors['description']; ?></p>
        <?php endif; ?>
    </div>

    <input type="hidden" name="id" value="<?= !isset($property) ? '' : $property['id'] ?>">
    <input type="hidden" name="baseImg" value="<?= !isset($property) ? '' : $property['img'] ?>">

    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            <?php if(strpos($_SERVER['REQUEST_URI'],'new.php')): ?>
                Add
            <?php else: ?>
                Update
            <?php endif; ?>
        </button>
    </div>
</form>

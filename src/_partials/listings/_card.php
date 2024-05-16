<?php $fullDescription = htmlspecialchars($property['description']); ?>

<!-- Card 1 -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden relative">
    <div class="relative">
        <img class="w-full h-56 object-cover object-center" src="<?= $property['img'] ?>" alt="Property">
        <span class="absolute bottom-0 right-0 px-7 py-1 font-bold bg-slate-200 rounded-tl-lg"><?= ucfirst($property['transaction']) ?></span>
    </div>
    <div class="p-4">
        <div class="flex justify-between items-center">
            <h3 class="text-gray-900 font-bold text-xl"><?= $property['title'] ?></h3>
            <p class="text-gray-900 font-semibold"><?= number_format($property['price']) ?>€ <?php if ($property['transaction'] === 'rent'): ?> /month<?php endif; ?></p>
        </div>
        <p class="text-gray-600"><?= $property['city'] ?>, France</p>
        <p class="text-gray-500 mt-2"><?= strlen($fullDescription) > 100 ? substr($fullDescription, 0, 100) . "..." : $fullDescription ?></p>
        <div class="flex items-center justify-between mt-3">
            <button class="px-3 py-2 bg-blue-500 text-white text-xs font-bold uppercase rounded">Contact</button>
            <div class="absolute top-0 right-0 p-4 flex flex-row-reverse">
                <?php if (!empty($_SESSION['isLoggedIn'])): ?>
                    <?php if($property['user_id'] === $_SESSION['id']): ?>
                        <div class="relative ml-4 menu-container">
                            <button class="optionsBtn focus:outline-none">
                                <i class="fa-solid fa-gear fa-2xl text-blue-400"></i>
                            </button>
                            <div class="optionsMenu hidden absolute right-4 top-3 w-32 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                                <a href="/src/listings/update.php?id=<?= $property['id'] ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                <a  href="/src/listings/delete.php?id=<?= $property['id'] ?>" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100">Supprimer</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php if ($property['isfavorite']): ?>
                            <a class="" href="/src/listings/toggleFavorite.php?id=<?= $property['id'] ?>"><i class="fa-solid fa-heart fa-2xl text-red-700 shadow-xl"></i></a>
                        <?php else: ?>
                            <a class="" href="/src/listings/toggleFavorite.php?id=<?= $property['id'] ?>"><i class="fa-regular fa-heart fa-2xl shadow-xl"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- End Card 1 -->
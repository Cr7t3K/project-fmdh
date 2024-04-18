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
            <?php if ($property['favorite']): ?>
                <a class="absolute top-0 right-0 p-4" href=""><i class="fa-solid fa-heart fa-2xl text-red-700 shadow-xl"></i></a>
            <?php else: ?>
                <a class="absolute top-0 right-0 p-4" href=""><i class="fa-regular fa-heart fa-2xl shadow-xl"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Card 1 -->
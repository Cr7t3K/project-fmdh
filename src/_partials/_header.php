<!-- Header -->
<header class="bg-white py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6">
        <div class="flex items-center">
            <a href="/" class="text-xl font-semibold text-gray-700">FindMyDreamHome</a>
        </div>
        <nav>
            <ul class="flex items-center space-x-4">
                <li><a href="/houses" class="text-gray-600 hover:text-gray-800">Houses</a></li>
                <li><a href="/apartments" class="text-gray-600 hover:text-gray-800">Apartments</a></li>
                <?php if (empty($_SESSION['isLoggedIn'])): ?>
                    <li><a href="/src/security/login.php" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Login</a></li>
                <?php else: ?>
                    <li>
                        <a href="/src/listings/new.php" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
                            <i class="fa-solid fa-plus mr-1"></i>Add
                        </a>
                    </li>
                    <li><a href="/src/security/logout.php" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">Logout</a></li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</header>
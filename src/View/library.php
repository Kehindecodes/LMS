<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="flex flex-col min-h-screen bg-gray-900 text-white">
    <nav class="bg-gray-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-7">
                    <a href="#" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-blue-400 text-lg">LMS</span>
                    </a>
                </div>

                <div class="flex-grow max-w-xl px-4">
                    <input type="text" placeholder="Search books..."
                        class="w-full px-4 py-2 rounded-full border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" hx-post="/books" hx-trigger="keyup changed" hx-target="#book-list" hx-indicator=".htmx-indicator" name="search">
                </div>

                <div class="flex items-center space-x-3">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 relative focus:outline-none">
                            <i class="fas fa-user text-blue-400"></i>
                            <i class="fas fa-chevron-down text-blue-400"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md overflow-hidden shadow-xl z-10">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700"><?php echo $_SESSION['user_name'] ?? 'User'; ?></a>
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="mb-6 flex justify-end">
            <a href="/addbook">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Book
                </button>
            </a>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6" hx-get="/books" hx-trigger="load" hx-target="this" id="book-list">
            <span id="indicator" class="htmx-indicator" style="display: none;">Loading...</span>
        </div>
    </main>

    <footer class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Library Management Systedm. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
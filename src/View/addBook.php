<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- add font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
</head>
<body class="flex flex-col min-h-screen bg-gray-900 text-white">
    <nav class="bg-gray-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="#" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-blue-400 text-lg">LMS</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 relative focus:outline-none">
                            <i class="fas fa-user text-blue-400"></i>
                            <!-- dropdown arrow -->
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
    <div id="book-list" class="mt-8"></div>
        <div class="bg-gray-800 p-10 rounded-lg w-full max-w-3xl mx-auto"> <!-- Changed max-w-lg to max-w-3xl -->
            <h1 class="text-3xl font-extrabold text-center text-blue-400 mb-6">Add a New Book</h1>
            <form hx-post="/book" hx-target="#book-list" class="w-full mx-auto" enctype="multipart/form-data"> <!-- Removed max-w-lg -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-300 font-semibold mb-2">Title</label>
                    <input type="text" id="title" name="title" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="author" class="block text-gray-300 font-semibold mb-2">Author</label>
                    <input type="text" id="author" name="author" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="isbn" class="block text-gray-300 font-semibold mb-2">ISBN</label>
                    <input type="text" id="isbn" name="ISBN" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="publicationDate" class="block text-gray-300 font-semibold mb-2">Publication Date</label>
                    <input type="date" id="publicationDate" name="publicationDate" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="genre" class="block text-gray-300 font-semibold mb-2">Genre</label>
                    <select id="genre" name="genre" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select a genre</option>
                        <option value="Action">Action</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Drama">Drama</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Horror">Horror</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Western">Western</option>
                        <option value="Biography">Biography</option>
                        <option value="History">History</option>
                        <option value="Science">Science</option>
                        <option value="Technology">Technology</option>
                        <option value="Travel">Travel</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-300 font-semibold mb-2">Image</label>
                    <input type="file" id="image" name="image" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-300 font-semibold mb-2">Description</label>
                    <textarea id="description" name="description" class="border border-gray-600 rounded-lg py-3 px-4 w-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg w-full transition duration-200">Add Book</button>
            </form>
        </div>
    </main>

    <footer class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Library Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

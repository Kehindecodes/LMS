<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100" hx-get="/book/<?php echo $book['id']; ?>" hx-target="this" hx-trigger="load" hx-indicator=".htmx-indicator" >
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-48 w-full object-cover md:w-48" src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold"><?php echo htmlspecialchars($book['genre']); ?></div>
                    <h1 class="mt-1 text-4xl leading-tight font-bold text-gray-900"><?php echo htmlspecialchars($book['title']); ?></h1>
                    <p class="mt-2 text-gray-600">By <?php echo htmlspecialchars($book['author']); ?></p>
                    <div class="mt-4">
                        <span class="text-gray-500">ISBN:</span>
                        <span class="ml-2 text-gray-900"><?php echo htmlspecialchars($book['ISBN']); ?></span>
                    </div>
                    <div class="mt-2">
                        <span class="text-gray-500">Publication Date:</span>
                        <span class="ml-2 text-gray-900"><?php echo htmlspecialchars($book['publicationDate']); ?></span>
                    </div>
                    <p class="mt-4 text-gray-600"><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
                    <div class="mt-6 flex items-center">
                        <a href="/editbook/<?php echo $book['id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <button hx-delete="/deletebook/<?php echo $book['id']; ?>" hx-confirm="Are you sure you want to delete this book?" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-trash-alt mr-2"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

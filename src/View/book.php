<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>

<body>
    <h1>Book List</h1>

    <div >
        <input type="text" hx-post="/books" hx-trigger="keyup changed" hx-target="#book-list"  name="search" placeholder="Search books...">
        <div id="book-list" hx-get="/books" hx-trigger="load" hx-target="this">
            <span id="indicator" class="htmx-indicator" style="display: none;">Loading...</span>
        </div>
    </div>
</body>

</html>
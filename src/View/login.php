<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex justify-center items-center h-screen">
        <div class="bg-gray-800 p-10 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-extrabold text-center text-blue-400 mb-6">Login</h2>
            <form hx-post="/handle-login" hx-target="#form-response">
                <div class="mb-4">
                    <label for="email" class="block text-gray-300 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="bg-gray-700 border border-gray-600 text-white rounded-lg py-3 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-300 font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-700 border border-gray-600 text-white rounded-lg py-3 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg w-full transition duration-200">Login</button>
            </form>
            <div id="form-response" class="mt-4"></div>
            <p class="mt-4 text-center text-gray-400">Don't have an account? <a href="/register" class="text-blue-400 hover:underline">Sign up</a></p>
        </div>
    </div>
</body>
</html>

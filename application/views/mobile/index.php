<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Business Management App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.19.0/dist/full.css" rel="stylesheet" />
    <style>
        body {
            background-color: #1a1a1a; /* Black Background */
            color: #00ff7f; /* Green Text */
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- App Header -->
    <header class="p-4 flex justify-between items-center bg-gray-900 text-green-500">
        <h1 class="text-xl font-bold">Quattro</h1>

        <!-- Hamburger Menu Button -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-square btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>

            <!-- Dropdown Menu for Mobile -->
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-gray-800 rounded-box w-52">
                <li><a href="#" class="text-green-500">Dashboard</a></li>
                <li><a href="#" class="text-green-500">Settings</a></li>
            </ul>
        </div>

        <!-- Full Menu for Larger Screens -->
        <nav class="hidden lg:flex space-x-4">
            <a href="#" class="btn btn-outline text-green-500">Dashboard</a>
            <a href="#" class="btn btn-outline text-green-500">Settings</a>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="p-4">
        <!-- Task Section -->
        <section class="mb-6">
            <h2 class="text-green-400 text-lg font-semibold mb-2">Tasks</h2>
            <ul class="space-y-2">
                <li class="p-4 bg-gray-800 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Task Name 1</p>
                    <p class="text-xs text-gray-400">Due: 12th Oct</p>
                </li>
                <li class="p-4 bg-gray-800 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Task Name 2</p>
                    <p class="text-xs text-gray-400">Due: 15th Oct</p>
                </li>
            </ul>
        </section>

        <!-- Invoice Section -->
        <section class="mb-6">
            <h2 class="text-green-400 text-lg font-semibold mb-2">Invoices</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-gray-800 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Invoice #001</p>
                    <p class="text-xs text-gray-400">Total: $500</p>
                </div>
                <div class="p-4 bg-gray-800 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Invoice #002</p>
                    <p class="text-xs text-gray-400">Total: $1200</p>
                </div>
            </div>
        </section>

        <!-- Add Task/Invoice Button -->
        <div class="fixed bottom-4 right-4">
            <button class="btn btn-circle btn-green">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </main>
</body>
</html>

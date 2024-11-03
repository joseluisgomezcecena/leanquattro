<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Business Management App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.19.0/dist/full.css" rel="stylesheet" />
    <style>
        body {
            background-color: #ffffff; /* White Background */
            color: #000000; /* Black Text */
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- App Header p4 bg-gray-100 text-gray-800-->
    <header class="px-10 p-2 flex justify-between items-center bg-slate-900 text-gray-800">
        <h1 class="text-xl font-bold">
            <img src="<?php echo base_url("assets/images/logopage.png"); ?>" alt="Logo" class="w-24" />
        </h1>

        <!-- Hamburger Menu Button -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-square btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>

            <!-- Dropdown Menu for Mobile -->
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white rounded-box w-52">
                <li><a href="<?php echo base_url("operator/andon") ?>" class="text-gray-800">Andon</a></li>
                <li><a href="<?php echo base_url("operator") ?>" class="text-gray-800">Hora x Hora</a></li>
            </ul>
        </div>

        <!-- Full Menu for Larger Screens -->
        <nav class="hidden lg:flex space-x-4">
            <a href="<?php echo base_url("operator") ?>" class="btn btn-outline border-white text-gray-100">Hora x Hora</a>
            <a href="<?php echo base_url("operator/andon") ?>" class="btn btn-outline border-white text-gray-100">Andon</a>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="p-4">
       
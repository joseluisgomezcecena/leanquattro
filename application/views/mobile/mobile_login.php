<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - MyBusiness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.19.0/dist/full.css" rel="stylesheet" />
    <style>
        body {
            background-color: #1a1a1a; /* Black background */
            color: #00ff7f; /* Green text */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <!-- Login Card -->
    <div class="card w-96 bg-gray-800 shadow-lg rounded-lg">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center text-green-400 mb-6">Login to MyBusiness</h2>
            
            <!-- Login Form -->
            <form>
                <!-- Email Input -->
                <div class="mb-4">
                    <label class="block text-sm text-green-400 mb-2" for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email" class="input input-bordered w-full bg-gray-900 text-green-400" required>
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label class="block text-sm text-green-400 mb-2" for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password" class="input input-bordered w-full bg-gray-900 text-green-400" required>
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-block btn-green">Login</button>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="#" class="text-sm text-green-500 hover:text-green-300">Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

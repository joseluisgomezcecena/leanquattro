<!-- Login Card -->
<div class="card w-96 bg-gray-800 shadow-lg rounded-lg">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center text-green-400 mb-6">
                <img src="<?php echo base_url() ?>assets/images/logo-01.png" alt="logo" width="100" class="mx-auto">Nexus
            </h2>
            
            <!-- Login Form -->
            <form action="<?php echo base_url('auth/login'); ?>"  method="post" autocomplete="off">
                <!-- Email Input -->
                <div class="mb-4">
                    <label class="block text-sm text-green-400 mb-2" for="email">Email</label>
                    <input type="text" id="username" name="username"  placeholder="Usuario" class="input input-bordered w-full bg-gray-900 text-green-400" required>
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label class="block text-sm text-green-400 mb-2" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="input input-bordered w-full bg-gray-900 text-green-400" required>
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-block btn-green">Ingresar</button>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="#" class="text-sm text-green-500 hover:text-green-300">Olvidaste tu Contraseña?</a>
                </div>
            </form>
        </div>
    </div>
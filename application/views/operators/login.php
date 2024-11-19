<!-- Login Card -->
<div class="card w-96 bg-gray-800 shadow-lg rounded-lg">
    <div class="card-body">
        <h2 class="text-2xl font-bold text-center text-green-400 mb-6">
            <img src="<?php echo base_url() ?>assets/images/logo-01.png" alt="logo" width="100" class="mx-auto">
            Nexus - leanquattro
        </h2>
        
        <!-- Login Form -->
        <form action="<?php echo base_url('auth/login'); ?>"  method="post" autocomplete="off">
             <!-- CSRF Token -->
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <!-- Email Input -->
            <div class="mb-4">
                <label class="block text-sm text-green-400 mb-2" for="email">Email</label>
                <input type="text" id="username" name="username"  placeholder="Usuario" class="input input-bordered w-full bg-gray-900 text-green-400" required autocomplete="off">
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label class="block text-sm text-green-400 mb-2" for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="input input-bordered w-full bg-gray-900 text-green-400" required autocomplete="off">
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

<?php if ($this->session->flashdata('error')) : ?>

<div id="toast" style="z-index:10000000" class="toast">
    <div class="alert bg-red-600 text-white">
        <span>
            <?php echo $this->session->flashdata('error'); ?>
        </span>
    </div>
</div>

<?php endif; ?>


<!-- Breadcrumb bg-gray-50 dark:bg-gray-800 border border-gray-200-->
<nav class="mt-5 mb-10 flex px-5 py-3 text-dark  rounded-lg  dark:border-gray-700 max-sm:hidden" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="#" class="inline-flex items-center text-sm font-medium text-gray-900 hover:text-blue-600 dark:text-gray-900 dark:hover:text-blue-600">
        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
        </svg>
        Nexus Quattro
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-dark dark:hover:text-blue-600">Hora x Hora</a>
      </div>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-blue-600">Buscar Ordenes</span>
      </div>
    </li>
  </ol>
</nav>




<?php if ($this->session->flashdata('error')) : ?>
<div id="error-alert" class="alert alert-error px-5">
    <div class="flex-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <div class="flex-1">
        <label>
            <?php echo $this->session->flashdata('error'); ?>
        </label>
    </div>
</div>
<?php endif; ?>




 <section class="mb-6 px-5">
    <h2 class="text-gray-800 text-lg font-semibold mb-2"></h2>
    <div class="space-y-2">
        <form action="<?php echo base_url("operator"); ?>" method="post">    
            <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                <p class="text-sm font-medium">Codigo de barras</p>
                <!--tailwind input-->
                <input style="width:100%" type="text" id="scan" name="work_order_number" class="input input-bordered mt-5 mb-5" placeholder="Codigo de barras" required>
                <p class="text-xs text-gray-600">Use el codigo de barras en la orden. </p>

                <!-- Container for button to align it to the right -->
                <div class="flex justify-end">
                    <!--tailwind primary button-->
                    <button class="btn btn-dark mt-3 w-full sm:w-auto">Buscar</button>
                </div>
            </div>
        </form>    
        <!--
        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
            <p class="text-sm font-medium">Task Name 2</p>
            <p class="text-xs text-gray-600">Due: 15th Oct</p>
        </div>
        -->
    </div>
</section>

        <!-- Invoice Section 
        <section class="mb-6">
            <h2 class="text-gray-800 text-lg font-semibold mb-2">Invoices</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Invoice #001</p>
                    <p class="text-xs text-gray-600">Total: $500</p>
                </div>
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Invoice #002</p>
                    <p class="text-xs text-gray-600">Total: $1200</p>
                </div>
            </div>
        </section>
        -->

        <!-- Add Task/Invoice Button -->
        <div class="fixed bottom-4 right-4">
            <button class="btn btn-circle btn-green">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
   
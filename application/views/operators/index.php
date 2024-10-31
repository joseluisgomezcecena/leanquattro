 <!-- Task Section -->
 <section class="mb-6">
            <h2 class="text-gray-800 text-lg font-semibold mb-2">Ordenes</h2>
            <div class="space-y-2">
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <p class="text-sm font-medium">Codigo de barras</p>
                    <!--tailwind input-->
                    <input style="width:100%" type="text" id="scan" class="input input-bordered mt-5 mb-5" placeholder="Codigo de barras">
                    <p class="text-xs text-gray-600">Use el codigo de barras en la orden. </p>

                    <!-- Container for button to align it to the right -->
                    <div class="flex justify-end">
                        <!--tailwind primary button-->
                        <button class="btn btn-primary mt-3">Buscar</button>
                    </div>
                </div>
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
   
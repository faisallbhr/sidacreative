<div id="editModal" class="hidden absolute w-full h-[100dvh] bg-black bg-opacity-50 justify-center items-center">
    <form action="{{ route('report.edit') }}" method="POST" class="bg-white rounded max-w-md w-full block p-8 relative mx-4">
        @csrf
        <button type="button" class="w-6 h-6 absolute top-2 right-2 border border-gray-400 rounded-full p-0.5 cursor-pointer flex items-center justify-center hover:bg-gray-300 hover:text-gray-800 duration-300" onclick="closeEditModal()">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <h2 class="text-black font-bold text-xl text-center">Edit Product</h2>

        <div class="mb-4 mt-6 space-y-4">
            <input type="hidden" name="productId" id="productId">
            <div class="flex flex-col">
                <label for="sku" class="text-black">SKU:</label>
                <input type="text" id="sku" name="sku" class="px-2 py-1 rounded-sm mt-1" disabled>
            </div>
            <div class="flex flex-col">
                <label for="stock_opname" class="text-black">Stock Opname:</label>
                <input type="number" id="stock_opname" name="stock_opname" class="px-2 py-1 rounded-sm mt-1">
            </div>
            <div class="flex flex-col">
                <label for="item_in" class="text-black">Barang Masuk:</label>
                <input type="number" id="item_in" name="item_in" class="px-2 py-1 rounded-sm mt-1">
            </div>
            <div class="flex flex-col">
                <label for="item_out" class="text-black">Barang Keluar:</label>
                <input type="number" id="item_out" name="item_out" class="px-2 py-1 rounded-sm mt-1">
            </div>
        </div>
        <button type="submit" class="bg-blue-500 rounded-sm text-white px-3 py-1 mt-4 mx-auto block hover:bg-opacity-80 duration-300">Submit</button>
    </form>
</div>

<script>
    function closeEditModal(){
        const editModal = document.getElementById('editModal');
        editModal.style.display = 'none';
    }
</script>
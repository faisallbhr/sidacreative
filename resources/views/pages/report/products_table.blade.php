<table class="w-full border-collapse text-sm lg:text-base">
    <thead>
        <tr>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2 rounded-l-sm">No.</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2">SKU</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2">Stock Opname</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2">Barang Masuk</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2">Barang Keluar</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2">Stock Akhir</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2">D/W</th>
            <th class="bg-gray-200 py-2 overflow-hidden whitespace-nowrap text-ellipsis px-2 rounded-r-sm">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td class="border-b py-2 text-center">{{ $loop->iteration }}</td>
                <td class="border-b py-2 text-center min-w-20">{{ $product->sku }}</td>
                <td class="border-b py-2 text-center">{{ $product->stock_opname }}</td>
                <td class="border-b py-2 text-center">{{ $product->item_in }}</td>
                <td class="border-b py-2 text-center">{{ $product->item_out }}</td>
                <td class="border-b py-2 text-center">{{ $product->total_stock }}</td>
                <td class="border-b py-2 text-center">{{ $product->dw }}</td>
                <td class="border-b py-2 flex justify-center gap-2">
                    <button onclick="openEditModal({{ $product->id }})" class="bg-yellow-500 px-2 py-1 text-white rounded-sm hover:bg-opacity-80 duration-300"><i class="fa-solid fa-pen"></i></button>
                    <form action="{{ route('report.delete', ['id' => $product->id]) }}" method="POST" id="delete-form-{{ $product->id }}" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $product->id }})" class="bg-red-500 px-2 py-1 text-white rounded-sm hover:bg-opacity-80 duration-300"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- <div class="my-4 report-pagination">
    {{ $products->onEachSide(1)->links() }}
</div> --}}

@php
    $jsonData = $products->toArray();
@endphp
<script>
    function openEditModal(productId){
        const products = @json($jsonData);
        const product = products.data.find(function(product) {
            return product.id === productId;
        });

        $('#productId').val(product.id);
        $('#sku').val(product.sku);
        $('#stock_opname').val(product.stock_opname);
        $('#item_in').val(product.item_in);
        $('#item_out').val(product.item_out);

        const modal = document.getElementById('editModal');
        modal.style.display = 'flex';
    }

    function confirmDelete(productId) {
        if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
            document.getElementById('delete-form-' + productId).submit();
        }else {
            event.preventDefault();
        }
    }
</script>
<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <button class="bg-blue-500 text-white px-3 py-1 rounded-sm mb-4 shadow-md hover:bg-opacity-80 duration-300" onclick="openModal()">Upload File</button>
        <div class="bg-white rounded-sm p-4 shadow-md">
            <div class="flex flex-wrap justify-between items-center mb-4 gap-4">
                <div class="flex gap-2 items-center">
                    <label for="searchSKU" class="whitespace-nowrap">Search SKU:</label>
                    <input type="text" id="searchInput" class="px-1 py-0.5 rounded-sm border-gray-300 placeholder:text-gray-400 max-w-40 w-full">
                </div>
                <div>
                    <select name="platform" id="platformSelected" class="rounded border-gray-300 py-0.5">
                        <option selected value="shopee">Shopee</option>
                        <option value="tiktok">Tiktok</option>
                        <option value="lazada">Lazada</option>
                    </select>
                </div>
            </div>
            <div id="productsTable" class="overflow-x-auto">
                @include('pages.report.products_table', ['products' => $products])
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let typingTimer;
            const doneTypingInterval = 500;

            $('#searchInput').on('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(fetchProducts, doneTypingInterval);
            });

            $('#platformSelected').change(function() {
                fetchProducts();
            });
            
            function fetchProducts() {
                const searchKeyword = $('#searchInput').val();
                const platform = $('#platformSelected').val();
                
                $.ajax({
                    url: "{{ route('report.search') }}",
                    type: "GET",
                    data: { 
                        search: searchKeyword,
                        platform: platform 
                    },
                    success: function (data) {
                        $('#productsTable').html(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>
</x-app-layout>
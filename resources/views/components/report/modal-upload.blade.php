<div id="modal" class="hidden absolute w-full h-[100dvh] bg-black bg-opacity-50 justify-center items-center">
    <form action="{{ route('report.import') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded max-w-sm w-full block p-8 relative mx-4">
        @csrf
        <button type="button" class="w-6 h-6 absolute top-2 right-2 border border-gray-400 rounded-full p-0.5 cursor-pointer flex items-center justify-center hover:bg-gray-300 hover:text-gray-800 duration-300" onclick="closeModal()">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <h2 class="text-black font-bold text-xl text-center">Upload File</h2>
        <div class="mb-4 mt-6">
            <label>
                <input type="file" name="fileInput" onchange="updateFileName(this)" hidden accept=".xls,.xlsx">
                <div class=" w-full aspect-video rounded flex flex-col items-center justify-center border-2 border-dashed border-gray-300 cursor-pointer ">
                    <div class="text-7xl">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <span id="fileLabel" class="max-w-60 w-full text-black overflow-hidden text-ellipsis text-center">Select file</span>
                </div>
            </label>
        </div>
        <select name="platform" id="platform" class="rounded text-black block w-full">
            <option class="text-black" value="shopee">Shopee</option>
            <option class="text-black" value="tiktok">Tiktok</option>
            <option class="text-black" value="lazada">Lazada</option>
        </select>
        <button type="submit" class="bg-blue-500 rounded-sm text-white px-3 py-1 mt-4 mx-auto block hover:bg-opacity-80 duration-300">Submit</button>
    </form>
</div>

<script>
    function updateFileName(input) {
        const fileLabel = document.getElementById('fileLabel');
        if (input.files.length > 0) {
            fileLabel.textContent = input.files[0].name;
        }
    }

    function openModal(){
        const modal = document.getElementById('modal');
        modal.style.display = 'flex';
    }

    function closeModal(){
        const modal = document.getElementById('modal');
        modal.style.display = 'none';
    }
</script>
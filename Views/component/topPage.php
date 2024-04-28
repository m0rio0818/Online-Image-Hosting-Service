<div class="pt-50 flex flex-col items-center justify-center h-full prose">
    <h1 class="text-center text-sky-500">Image Sharing</h1>
    <div class="flex flex-col items-center border-gray-300 bg-gray-100 py-4 card sm:w-1/2 w-5/6 my-4 mx-auto px-5">
        <div class="flex items-center">
            <i class="fa-solid fa-gear fa-2xn  mx-1"></i>
            <h2 class="font-bold">Options</h2>
        </div>
        <div class="relative">
            <input type="file" id="file_input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            <label for="file_input" class="block w-full bg-gray-100 hover:bg-gray-200 rounded-lg p-4 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-center">Choose a file</span>
            </label>
        </div>
        <div class="flex  items-center w-full py-2 pl-10">
            <div class="pr-3">
                <label for="title">Title:</label>
            </div>
            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full focus:ring-blue-500 mx-auto focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="title">
        </div>
        <div class="flex items-center w-full py-2 pl-10">
            <input id="publish" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="publish" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Add Publish Image List</label>
        </div>
        <div class="w-full py-2 flex justify-center">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-full" id="upload_image">Upload Image</button>
        </div>
    </div>
</div>
<script src="/js/main.js"></script>
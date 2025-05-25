<div class="fixed flex flex-col dark:bg-[#101623] items-center w-16 h-screen overflow-hidden text-l-2 bg-l-3">
    <a class="flex items-center justify-center mt-3">
        <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
        </svg>
    </a>
    <div class="flex flex-col items-center mt-3 border-t border-black dark:border-gray-700">
        <?php
        foreach ($components as $key => $component) {
        ?>
            <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-black hover:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white" href="<?= $component["url"] ?? "#" ?>">
                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $component["icon"] ?>" />
                </svg>
            </a>
        <?php
        }
        ?>
    </div>
    
    <div class="flex flex-col items-center mt-2">
        <button
            id="donateBtn"
            class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-green-600 hover:text-white bg-green-500 text-white"
            onclick="document.getElementById('donateModal').classList.remove('hidden')"
            title="Donate via UPI">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3 0 1.657 1.343 3 3 3s3-1.343 3-3c0-1.657-1.343-3-3-3zm0 0V4m0 7v7m-7-7h14" />
            </svg>
        </button>
    </div>

    <div id="donateModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 dark:bg-opacity-70">
        <div class="bg-white dark:bg-[#101623] p-6 rounded shadow-lg relative w-80 text-gray-900 dark:text-gray-100">
            <button onclick="document.getElementById('donateModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-2 text-center">Support Us</h2>
            <p class="mb-4 text-center">Scan the QR or use the UPI ID below to donate:</p>
            <div class="flex justify-center mb-2">
                <img src="../../../../Images/qr.jpg" alt="UPI QR Code" class="w-32 h-32 rounded border dark:border-gray-700" />
            </div>
            <div class="text-center mb-2">
                <span class="font-mono bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded text-sm select-all text-gray-900 dark:text-gray-100">7024888951@slc</span>
            </div>
            <div class="text-center text-xs text-gray-500 dark:text-gray-400">Thank you for your support!</div>
        </div>
    </div>
    <div class="flex flex-col items-center mt-2 border-t border-black dark:border-gray-700">
        <?php loadComponent("ThemeToggle", ["classes" => "absolute bottom-1 left-0 w-full flex justify-center items-center"]); ?>
    </div>
</div>
<?php

use Framework\Session;
?>
<header class="bg-gray-100 dark:bg-[#101623] shadow-sm">
    <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center gap-3">
            <i class="fas fa-book-reader text-gray-700 dark:text-gray-300 text-2xl"></i>
            <span class="text-xl font-semibold text-gray-700 dark:text-gray-300">LibraNet</span>
        </div>
        <div class="bg-black-500 text-black px-4 py-2 rounded-lg text-sm md:text-base font-medium shadow-md 
                    dark:bg-black-600 mt-2 md:mt-0 dark:text-white">
            Incharge ID: <?= Session::get("incharge")["Id"]; ?>
        </div>
    </div>
</header>
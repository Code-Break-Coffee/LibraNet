<?php
use Framework\Session;
?>
<header class="bg-gray-100 dark:bg-[#101623] shadow-sm">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fas fa-book-reader text-gray-700 dark:text-gray-300 text-2xl"></i>
                <span class="text-xl font-semibold text-gray-700 dark:text-gray-300">LibraNet</span>
            </div>
            <div class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm md:text-base font-medium shadow-md 
                    dark:bg-blue-600 dark:text-white mt-2 md:mt-0">
                Incharge ID: <?= Session::get("incharge")["Id"]; ?>
            </div>
        </div>
    </header>
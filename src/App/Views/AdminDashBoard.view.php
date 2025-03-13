<?php
    loadComponent("Head");
    loadComponent("Sidebar");
?>
       <div class="flex-1 bg-l-1 dark:bg-[#090A0C] ml-16">
            <header class="bg-l-2 dark:bg-[#101623] shadow-sm">
                <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-book-reader text-l-3 dark:text-d-3 text-2xl"></i>
                        <span class="ml-2 text-xl font-semibold text-l-3 dark:text-d-3">LibraNet</span>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Search books, members..." class="border dark:bg-[#101623] rounded-full py-2 px-4 pl-10 w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </header>
            <main class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-semibold text-l-3 dark:text-d-3 mb-6">Dashboard</h1>
                <?= loadComponent("AdminDashBoard/Stats"); ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <?php
                        loadComponent("AdminDashBoard/Transaction");
                        loadComponent("AdminDashBoard/PopularBook");
                    ?>
                </div>
            </main>
        </div>
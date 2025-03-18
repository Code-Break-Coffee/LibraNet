<?php
loadComponent("Head");
loadComponent("Sidebar", [
    "components" => [
        "Home" => [
            "url" => "/incharge-dashboard",
            "icon" => "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6",
        ],
        "Transactions" => [
            "url" => "/incharge-transactions",
            "icon" => "M17 9V7a4 4 0 00-8 0v2M5 10h14a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1v-8a1 1 0 011-1z"
        ],
        "Profile" => [
            "url" => "/incharge-profile",
            "icon" => "M5.121 17.804A4 4 0 0112 14a4 4 0 016.879 3.804M12 14a4 4 0 100-8 4 4 0 000 8z"
        ],
        "Manipulation" => [
            "url" => "/incharge-manipulation",
            "icon" => "M4 19.5V5a2 2 0 012-2h10a2 2 0 012 2v14.5M16 2v16m-4-4l-4 4m0-4l4 4"
        ],
        "Search" => [
            "url" => "/incharge-search",
            "icon" => "M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        ],
        "Sign Out" => [
            "url" => "/incharge-signout",
            "icon" => "M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-10V4a3 3 0 00-6 0v1"
        ]
    ]
]);
?>
<div class="flex-1 bg-l-1 dark:bg-[#090A0C] ml-16">
    <header class="bg-l-2 dark:bg-[#101623] shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-book-reader text-l-3 dark:text-d-3 text-2xl"></i>
                <span class="ml-2 text-xl font-semibold text-l-3 dark:text-d-3">LibraNet</span>
            </div>
            <!-- <div class="relative">
                <input type="text" placeholder="Search books, members..." class="border dark:bg-[#101623] rounded-full py-2 px-4 pl-10 w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div> -->
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-l-3 dark:text-d-3 mb-6">Dashboard</h1>
        <?= loadComponent("InchargeDashBoard/Stats"); ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <?php
            loadComponent("InchargeDashBoard/Transaction");
            loadComponent("InchargeDashBoard/PopularBook");
            ?>
        </div>
    </main>
</div>
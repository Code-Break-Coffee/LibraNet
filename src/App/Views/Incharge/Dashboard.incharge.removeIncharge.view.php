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

<div class="flex-1 bg-white dark:bg-[#090A0C] ml-16 text-gray-900 dark:text-white h-screen">
    <?= loadComponent("InchargeDashboard/Header") ?>
    <main class="container mx-auto px-4 py-8 relative">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-300 mb-6">Profile</h1>
        <i id="gear" class="fa-solid fa-cog text-gray-600 dark:text-gray-300 text-2xl cursor-pointer absolute right-5 top-10"></i>
        <div class="hidden forms absolute right-5 top-20 mt-2 w-48 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-lg rounded-md">
            <a href="/add-incharge" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-700">Add Incharge</a>
            <a href="/remove-incharge" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-700">Remove Incharge</a>
            <a href="/incharge-change-profile" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-700">Change Profile</a>
            <a href="/ban-member" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-700">Ban Member</a>
        </div>
        <div class="flex justify-center items-center min-h-[70vh]">
            <div class="max-w-lg bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Remove Incharge</h2>
                <input type="text" name="incharge_id" placeholder="Incharge ID" class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded w-full hover:bg-red-700">Remove</button>
            </div>
        </div>
    </main>
</div>

<?= loadComponent("Tail"); ?>
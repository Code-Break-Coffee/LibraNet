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
        "Requests" => [
            "url" => "/incharge-requests",
            "icon" => "M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
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
<div class="flex-1 bg-l-1 dark:bg-[#090A0C] ml-16 min-h-screen">
    <?= loadComponent("InchargeDashboard/Header") ?>
    <!-- <div class="relative">
                <input type="text" placeholder="Search books, members..." class="border dark:bg-[#101623] rounded-full py-2 px-4 pl-10 w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div> -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-300 mb-6">Issue Requests</h1>
        <ul class="space-y-4">
            <?php foreach ($requests as $request): ?>
                <li class="p-4 bg-white dark:bg-[#101623] rounded-lg shadow">
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-black dark:text-d-1 ml-3">Member:&nbsp;&nbsp;&nbsp;<?= $request->email ?></h3>
                            <h3 class="text-xl font-semibold text-black dark:text-d-1 mr-3">Book No:&nbsp;<?= $request->BookNo ?></h3>
                        </div>
                        <div class="flex justify-between items-center gap-10 mt-2">
                            <div class="ml-3">
                                <p class="text-black dark:text-gray-300"><b>Title:</b> <?= $request->Title ?></p>
                                <p class="text-black dark:text-gray-300"><b>Author 1:</b> <?= $request->Author1 ?? "NA" ?></p>
                                <p class="text-black dark:text-gray-300"><b>Author 2:</b> <?= $request->Author2 ?? "NA" ?></p>
                                <p class="text-black dark:text-gray-300"><b>Author 3:</b> <?= $request->Author3 ?? "NA" ?></p>
                            </div>
                            <div class="mr-3">
                                <p class="text-black dark:text-gray-300 text-right"><b>Edition:</b> <?= $request->Edition ?></p>
                                <p class="text-black dark:text-gray-300 text-right"><b>Publisher:</b> <?= $request->Publisher ?></p>
                                <p class="text-black dark:text-gray-300 text-right"><b>Remark:</b> <?= $request->Remark ?></p>
                                <p class="text-black dark:text-gray-300 text-right"><b>Request Date:</b> <?= $request->Created_date ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-4 ml-3">
                        <form action="/incharge-accept" method="post">
                            <input type="hidden" name="bookNo" value="">
                            <button
                                type="submit"
                                class="w-[135px] h-[40px] rounded-lg bg-green-600 p-2 text-white hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 dark:shadow-lg dark:shadow-d-2/30">
                                Accept Request
                            </button>
                        </form>
                        <form action="/incharge-reject" method="post">
                            <input type="hidden" name="bookNo" value="">
                            <button
                                type="submit"
                                class="w-[135px] h-[40px] rounded-lg bg-red-600 p-2 text-white hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 dark:shadow-lg dark:shadow-d-2/30">
                                Reject Request
                            </button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="flex justify-center mt-4 space-x-4">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Previous
                </a>
            <?php endif; ?>

            <span class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                Page <?= $currentPage ?> of <?= $totalPages ?>
            </span>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Next
                </a>
            <?php endif; ?>
        </div>
    </main>
</div>
<?= loadComponent("Tail"); ?>
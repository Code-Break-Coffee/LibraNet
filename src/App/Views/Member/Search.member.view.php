<?= loadComponent("Head");

use Framework\Session;

$success = Session::getFlash("success");
loadComponent("Sidebar", [
    "components" => [
        "Home" => [
            "url" => "/member-dashboard",
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
            "url" => "/member-search",
            "icon" => "M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        ],
        "Sign Out" => [
            "url" => "/member-signout",
            "icon" => "M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-10V4a3 3 0 00-6 0v1"
        ]
    ]
]);
?>
<div class="flex-1 bg-l-1 dark:bg-[#090A0C] ml-16">
    <div class="flex items-center justify-between bg-white dark:bg-[#101623] border-b border-l-b-1 dark:border-d-2 p-4 shadow">
        <div class="flex items-center gap-3">
            <i class="fas fa-book-reader text-l-3 dark:text-gray-300 text-2xl"></i>
            <span class="text-xl font-semibold text-l-3 dark:text-gray-300">LibraNet</span>
        </div>
    </div>
    <main class="container mx-auto px-4 py-8 min-h-screen">
        <h1 class="text-2xl font-semibold text-l-3 dark:text-d-3 mb-6">Member Search</h1>
        <?= isset($errors) ? loadComponent("ErrorAlert", ["errors" => $errors ?? []]) : "" ?>
        <?= isset($success) ? loadComponent("SuccessAlert", ["success" => $success ?? ""]) : "" ?>
        <form action="/member-search" method="post" class="mb-6">
            <div class="flex items-center gap-4">
                <input
                    type="text"
                    name="search_query"
                    placeholder="Search any book..."
                    value="<?= htmlspecialchars($search_query ?? '') ?>"
                    class="flex-1 rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
                    required>
                <button
                    type="submit"
                    class="rounded-lg bg-l-3 p-3 text-l-7 hover:bg-[#722F37] dark:bg-d-3 dark:hover:bg-l-7 dark:text-[#262424] dark:shadow-lg dark:shadow-d-2/30">
                    Search
                </button>
            </div>
        </form>
        <div>
            <?php if (isset($searchResults) && !empty($searchResults)): ?>
                <h2 class="text-xl font-semibold text-l-3 dark:text-d-3 mb-4">Search Results</h2>
                <ul class="space-y-4">
                    <?php foreach ($searchResults as $book): ?>
                        <li class="p-4 bg-white dark:bg-[#101623] rounded-lg shadow flex justify-between">
                            <div class="w-full">
                                <h3 class="text-xl font-semibold text-black dark:text-d-1"><?= htmlspecialchars($book->Title) ?></h3>
                                <div class="flex justify-between items-center gap-10 mt-2 mr-16">
                                    <div>
                                        <p class="text-black dark:text-gray-300"><b>Author 1:</b> <?= htmlspecialchars($book->Author1) ?></p>
                                        <p class="text-black dark:text-gray-300"><b>Author 2:</b> <?= htmlspecialchars($book->Author2 ?? "NA") ?></p>
                                        <p class="text-black dark:text-gray-300"><b>Author 3:</b> <?= htmlspecialchars($book->Author3 ?? "NA") ?></p>
                                    </div>
                                    <div>
                                        <p class="text-black dark:text-gray-300 text-right"><b>Edition:</b> <?= htmlspecialchars($book->Edition) ?></p>
                                        <p class="text-black dark:text-gray-300 text-right"><b>Publisher:</b> <?= htmlspecialchars($book->Publisher) ?></p>
                                        <p class="text-black dark:text-gray-300 text-right"><b>Remark:</b> <?= htmlspecialchars($book->Remark) ?></p>
                                    </div>
                                </div>
                            </div>
                            <form action="/member-issue-book" method="post">
                                <input type="hidden" name="bookNo" value="<?= $book->BookNo ?>">
                                <button
                                    type="submit"
                                    class="w-[100px] h-[40px] rounded-lg bg-green-600 p-2 text-white hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 dark:shadow-lg dark:shadow-d-2/30">
                                    Issue Book
                                </button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif (isset($searchResults) && empty($searchResults)): ?>
                <p class="text-black dark:text-gray-300 bg-white dark:bg-[#101623] rounded-lg p-4 shadow">No results found.</p>
            <?php endif; ?>
            <div class="flex justify-center mt-4 space-x-4">
                <?php if (($currentPage ?? 1) > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>&search_query=<?= urlencode($search_query ?? '') ?>" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Previous
                    </a>
                <?php endif; ?>

                <span class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                    Page <?= $currentPage ?? 1 ?> of <?= $totalPages ?? 1 ?>
                </span>

                <?php if (($currentPage ?? 1) < ($totalPages ?? 1)): ?>
                    <a href="?page=<?= $currentPage + 1 ?>&search_query=<?= urlencode($search_query ?? '') ?>" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Next
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>
<?= loadComponent("Tail") ?>
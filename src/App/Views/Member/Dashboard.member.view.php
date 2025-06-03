<?=loadComponent("Head");
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
    <div class="flex items-center justify-between bg-white dark:bg-[#101623] border-b dark:border-d-2 p-4 shadow">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
                <i class="fas fa-book-reader text-white dark:text-gray-300 text-2xl"></i>
                <span class="text-xl font-semibold text-white dark:text-gray-300">LibraNet</span>
            </div>
            <div class="text-xl font-semibold text-white dark:text-gray-300">
                ID: <?= $memberID ?>
            </div>
        </div>
    </div>
    <!-- <div class="relative">
                <input type="text" placeholder="Search books, members..." class="border dark:bg-[#101623] rounded-full py-2 px-4 pl-10 w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div> -->
    <main class="container mx-auto px-4 py-8">
    <div class="container mx-auto">
     <h1 class="text-2xl font-semibold text-blue dark:text-white mb-6">
      User Dashboard
     </h1>
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white dark:bg-[#101623] p-6 rounded-lg shadow-sm">
       <div class="flex items-center justify-between">
        <div>
         <h2 class="text-black dark:text-white">
          Total Book Issued
         </h2>
         <p class="text-3xl font-semibold text-black dark:text-white">
          <?=$number_of_books_issued?>
         </p>
        </div>
        <i class="fas fa-book text-blue-500 text-2xl">
        </i>
       </div>
      </div>
      <div class="bg-white dark:bg-[#101623] p-6 rounded-lg shadow-sm">
       <div class="flex items-center justify-between">
        <div>
         <h2 class="text-black dark:text-white">
          Books Dues
         </h2>
         <p class="text-3xl font-semibold text-black dark:text-white">
          <?=$number_of_books_due?>
         </p>
        </div>
        <i class="fas fa-book-reader text-blue-500 text-2xl">
        </i>
       </div>
      </div>
      <div class="bg-white dark:bg-[#101623] p-6 rounded-lg shadow-sm">
       <div class="flex items-center justify-between">
        <div>
         <h2 class="text-black dark:text-white">
          Favorite Book
         </h2>
         <p class="text-2xl font-semibold text-black dark:text-white">
          <?=$favorite_book?>
         </p>
        </div>
        <i class="fas fa-clock text-blue-500 text-2xl">
        </i>
       </div>
      </div>
     </div>
     <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php   
            loadComponent("InchargeDashBoard/Transaction",[
                "recentTransactionBooks" => $recentTransactionBooks ?? []
            ]);
            loadComponent("MemberDashBoard/PopularBook",[
                "popularBooks" => $popularBooks ?? []
            ]);
        ?>
     </div>
     </div>
    </div>
    </main>
</div>

<?=loadComponent("Tail")?>

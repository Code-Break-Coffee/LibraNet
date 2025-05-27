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
        <div class="flex items-center gap-3">
            <i class="fas fa-book-reader text-white dark:text-gray-300 text-2xl"></i>
            <span class="text-xl font-semibold text-white dark:text-gray-300">LibraNet</span>
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
      <div class="bg-white dark:bg-[#090A0C] p-6 rounded-lg shadow-sm">
       <div class="flex items-center justify-between">
        <div>
         <h2 class="text-black dark:text-white">
          Total Books
         </h2>
         <p class="text-3xl font-semibold text-black dark:text-white">
          2,543
         </p>
         <p class="text-green-500">
          +12 added this month
         </p>
        </div>
        <i class="fas fa-book text-blue-500 text-2xl">
        </i>
       </div>
      </div>
      <div class="bg-white dark:bg-[#090A0C] p-6 rounded-lg shadow-sm">
       <div class="flex items-center justify-between">
        <div>
         <h2 class="text-black dark:text-white">
          Books Checked Out
         </h2>
         <p class="text-3xl font-semibold text-black dark:text-white">
          342
         </p>
         <p class="text-green-500">
          +18% from last month
         </p>
        </div>
        <i class="fas fa-book-reader text-blue-500 text-2xl">
        </i>
       </div>
      </div>
      <div class="bg-white dark:bg-[#090A0C] p-6 rounded-lg shadow-sm">
       <div class="flex items-center justify-between">
        <div>
         <h2 class="text-black dark:text-white">
          Overdue Returns
         </h2>
         <p class="text-3xl font-semibold text-red-500">
          24
         </p>
         <p class="text-red-500">
          -3 from last week
         </p>
        </div>
        <i class="fas fa-clock text-blue-500 text-2xl">
        </i>
       </div>
      </div>
     </div>
     <div class="bg-l-2 dark:bg-[#101623] p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-xl font-semibold text-l-3 dark:text-d-3 mb-4">
       Recommended Books
      </h2>
      <p class="text-black dark:text-white mb-4">
       Books available for issuing
      </p>
      <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
       <li class="flex items-center bg-gray-100 dark:bg-[#090A0C] p-4 rounded-lg">
        <img alt="Book cover of The Catcher in the Rye" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
        <div>
         <p class="text-black dark:text-white font-semibold">
          The Catcher in the Rye
         </p>
         <p class="text-black dark:text-white">
          J.D. Salinger
         </p>
        </div>
       </li>
       <li class="flex items-center bg-gray-100 dark:bg-[#090A0C] p-4 rounded-lg">
        <img alt="Book cover of Pride and Prejudice" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
        <div>
         <p class="text-black dark:text-white font-semibold">
          Pride and Prejudice
         </p>
         <p class="text-black dark:text-white">
          Jane Austen
         </p>
        </div>
       </li>
       <li class="flex items-center bg-gray-100 dark:bg-[#090A0C] p-4 rounded-lg">
        <img alt="Book cover of The Alchemist" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
        <div>
         <p class="text-black dark:text-white font-semibold">
          The Alchemist
         </p>
         <p class="text-black dark:text-white">
          Paulo Coelho
         </p>
        </div>
       </li>
       <li class="flex items-center bg-gray-100 dark:bg-[#090A0C] p-4 rounded-lg">
        <img alt="Book cover of The Da Vinci Code" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
        <div>
         <p class="text-black dark:text-white font-semibold">
          The Da Vinci Code
         </p>
         <p class="text-black dark:text-white">
          Dan Brown
         </p>
        </div>
       </li>
       <li class="flex items-center bg-gray-100 dark:bg-[#090A0C] p-4 rounded-lg">
        <img alt="Book cover of The Hunger Games" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
        <div>
         <p class="text-black dark:text-white font-semibold">
          The Hunger Games
         </p>
         <p class="text-black dark:text-white">
          Suzanne Collins
         </p>
        </div>
       </li>
       <li class="flex items-center bg-gray-100 dark:bg-[#090A0C] p-4 rounded-lg">
        <img alt="Book cover of Harry Potter and the Sorcerer's Stone" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
        <div>
         <p class="text-black dark:text-white font-semibold">
          Harry Potter and the Sorcerer's Stone
         </p>
         <p class="text-black dark:text-white">
          J.K. Rowling
         </p>
        </div>
       </li>
      </ul>
     </div>
     <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white dark:bg-[#090A0C] p-6 rounded-lg shadow-sm">
       <h2 class="text-xl font-semibold text-l-3 dark:text-d-3 mb-4">
        Recent Transactions
       </h2>
       <p class="text-black dark:text-white mb-4">
        Latest book checkouts and returns
       </p>
       <ul>
        <li class="flex justify-between items-center mb-4">
         <div class="flex items-center">
          <i class="fas fa-book text-blue-500 text-2xl mr-4">
          </i>
          <div>
           <p class="text-black dark:text-white font-semibold">
            The Great Gatsby
           </p>
           <p class="text-black dark:text-white">
            Emma Thompson
           </p>
          </div>
         </div>
         <p class="text-blue-500">
          Checked Out
          <br/>
          <span class="text-gray-500">
           Today, 2:30 PM
          </span>
         </p>
        </li>
        <li class="flex justify-between items-center mb-4">
         <div class="flex items-center">
          <i class="fas fa-book text-blue-500 text-2xl mr-4">
          </i>
          <div>
           <p class="text-black dark:text-white font-semibold">
            To Kill a Mockingbird
           </p>
           <p class="text-black dark:text-white">
            Michael Johnson
           </p>
          </div>
         </div>
         <p class="text-green-500">
          Returned
          <br/>
          <span class="text-gray-500">
           Today, 11:15 AM
          </span>
         </p>
        </li>
        <li class="flex justify-between items-center mb-4">
         <div class="flex items-center">
          <i class="fas fa-book text-blue-500 text-2xl mr-4">
          </i>
          <div>
           <p class="text-black dark:text-white font-semibold">
            1984
           </p>
           <p class="text-black dark:text-white">
            Sarah Williams
           </p>
          </div>
         </div>
         <p class="text-blue-500">
          Checked Out
          <br/>
          <span class="text-gray-500">
           Yesterday, 4:45 PM
          </span>
         </p>
        </li>
        <li class="flex justify-between items-center">
         <div class="flex items-center">
          <i class="fas fa-book text-blue-500 text-2xl mr-4">
          </i>
          <div>
           <p class="text-black dark:text-white font-semibold">
            The Hobbit
           </p>
           <p class="text-black dark:text-white">
            David Miller
           </p>
          </div>
         </div>
         <p class="text-green-500">
          Returned
          <br/>
          <span class="text-gray-500">
           Yesterday, 10:20 AM
          </span>
         </p>
        </li>
       </ul>
      </div>
      <div class="bg-white dark:bg-[#090A0C] p-6 rounded-lg shadow-sm">
       <h2 class="text-xl font-semibold text-l-3 dark:text-d-3 mb-4">
        Popular Books
       </h2>
       <p class="text-black dark:text-white mb-4">
        Most checked out books this month
       </p>
       <ul>
        <li class="flex justify-between items-center mb-4">
         <div class="flex items-center">
          <img alt="Book cover of Atomic Habits" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
          <div>
           <p class="text-black dark:text-white font-semibold">
            Atomic Habits
           </p>
           <p class="text-black dark:text-white">
            James Clear
           </p>
          </div>
         </div>
         <p class="text-blue-500">
          42 checkouts
          <br/>
          <span class="text-gray-500">
           This month
          </span>
         </p>
        </li>
        <li class="flex justify-between items-center mb-4">
         <div class="flex items-center">
          <img alt="Book cover of The Silent Patient" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
          <div>
           <p class="text-black dark:text-white font-semibold">
            The Silent Patient
           </p>
           <p class="text-black dark:text-white">
            Alex Michaelides
           </p>
          </div>
         </div>
         <p class="text-blue-500">
          38 checkouts
          <br/>
          <span class="text-gray-500">
           This month
          </span>
         </p>
        </li>
        <li class="flex justify-between items-center mb-4">
         <div class="flex items-center">
          <img alt="Book cover of Educated" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
          <div>
           <p class="text-black dark:text-white font-semibold">
            Educated
           </p>
           <p class="text-black dark:text-white">
            Tara Westover
           </p>
          </div>
         </div>
         <p class="text-blue-500">
          35 checkouts
          <br/>
          <span class="text-gray-500">
           This month
          </span>
         </p>
        </li>
        <li class="flex justify-between items-center">
         <div class="flex items-center">
          <img alt="Book cover of Where the Crawdads Sing" class="w-12 h-12 mr-4" src="https://placehold.co/50x50"/>
          <div>
           <p class="text-black dark:text-white font-semibold">
            Where the Crawdads Sing
           </p>
           <p class="text-black dark:text-white">
            Delia Owens
           </p>
          </div>
         </div>
         <p class="text-blue-500">
          31 checkouts
          <br/>
          <span class="text-gray-500">
           This month
          </span>
         </p>
        </li>
       </ul>
      </div>
     </div>
    </div>
    </main>
</div>

<?=loadComponent("Tail")?>

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
    <main class="container mx-auto px-4 py-6 relative">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-300">InCharge Search</h1>
        <?php if ( !isset($search_type) || empty($members) && empty($books) && empty($incharges)) : ?>
        <div class="flex justify-center items-center mt-20 pt-20">
            <div class="max-w-lg bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <?= isset($search_errors) ? loadComponent("ErrorAlert", ["errors" => $search_errors ?? []]) : "" ?>
                <?=isset($success) ? loadComponent("SuccessAlert",["msg" => $success ?? ""]) : ""?>
                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Search</h2>
                <form action="/incharge-search" method="POST">
                    <input type="text" name="search" placeholder="Search" class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <select name="search_type" class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="" selected>Select</option>
                        <option value="member">Member</option>
                        <option value="book">Book</option>
                    </select>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full hover:bg-green-700">Search</button>
                </form>
            </div>
            <?php endif; ?>
            <div>
            <?php if (isset($search_type) && $search_type == "member" && !empty($members)) : ?>
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Search Results</h2>
                    <a href="/incharge-search"><button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Close</button></a>
                </div>
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">First Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Middle Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Last Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Phone Number</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Address</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $result) : ?>
                            <tr class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->FName ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->MName ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->LName ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->PhoneNo ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Address ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    <a href="/ban-member?member_id=<?= $result->id ?>">
                                        <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                                                <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                                            </svg>
                                        </button>
                                    </a>
                                    <a href="/unban-member?member_id=<?= $result->id ?>">
                                        <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                <path d="M13.354 4.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L6 10.293l6.646-6.647a.5.5 0 0 1 .708 0Z"/>
                                            </svg>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif (isset($search_type) && $search_type == "book" && !empty($books)) : ?>
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Search Results</h2>
                    <a href="/incharge-search"><button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Close</button></a>
                </div>
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Book No.</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Title</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Author 1</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Author 2</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Author 3</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Edition</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rating</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Status</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $result) : ?>
                            <tr class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->BookNo ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Title ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Author1 ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Author2 ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Author3 ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Edition ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Rating ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Status ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    <a href="/incharge-delete-book?book_no=<?= $result->BookNo ?>">
                                        <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            Delete
                                        </button>
                                    </a>
                                    <a href="/incharge-edit-book?book_no=<?= $result->BookNo ?>">
                                        <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                            Edit
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif (isset($search_type) && $search_type == "incharge" && !empty($incharges)) : ?>
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Search Results</h2>
                    <a href="/incharge-search"><button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Close</button></a>
                </div>
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">First Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Middle Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 ">Last Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Phone Number</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Designation</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incharges as $result) : ?>
                            <tr class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->FName ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->MName ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->LName ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->PhoneNo ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Designation ?></td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?= $result->Tier ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        </div>
    </main>
</div>
<?php loadComponent("Tail"); ?>

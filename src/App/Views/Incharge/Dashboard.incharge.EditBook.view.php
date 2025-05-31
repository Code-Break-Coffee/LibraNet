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

<div class="flex-1 bg-white dark:bg-[#090A0C] ml-16 text-gray-900 dark:text-white h-screen">
    <?= loadComponent("InchargeDashboard/Header") ?>
    <main class="container mx-auto px-4 py-8 relative">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-300 mb-6">Profile</h1>
        <?=loadComponent("InchargeDashboard/GearForms") ?>
        <div class="flex justify-center items-center min-h-[70vh]">
            <form method="POST" action="/incharge-edit-book" class="max-w-lg bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <?=isset($delete_errors) ? loadComponent("ErrorAlert",["errors"=>$delete_errors ?? []]) : ""?>
                <?=isset($success) ? loadComponent("SuccessAlert",["msg" => $success ?? ""]) : ""?>
                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Edit Book</h2>
                <input type="hidden" name="book_no" value='<?=(isset($_GET["book_no"]))?$_GET["book_no"]: ''?>' name="book_no" placeholder="Book ID" class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="book_name" 
                    value='<?= isset($book_detail->Title) ? $book_detail->Title : '' ?>' 
                    placeholder="Book Name" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>

                <input type="text" name="book_author1" 
                    value='<?= isset($book_detail->Author1) ? $book_detail->Author1 : '' ?>' 
                    placeholder="Book Author 1" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="book_author2" 
                    value='<?= isset($book_detail->Author2) ? $book_detail->Author2 : '' ?>' 
                    placeholder="Book Author 2" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="book_author3" 
                    value='<?= isset($book_detail->Author3) ? $book_detail->Author3 : '' ?>' 
                    placeholder="Book Author 3" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                
                <input type="text" name="edition" 
                    value='<?= isset($book_detail->Edition) ? $book_detail->Edition : '' ?>' 
                    placeholder="Book Edition" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>

                <input type="text" name="publisher" 
                    value='<?= isset($book_detail->Publisher) ? $book_detail->Publisher : '' ?>' 
                    placeholder="Book Publisher" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                
                <input type="text" name="pages" 
                    value='<?= isset($book_detail->Pages) ? $book_detail->Pages : '' ?>' 
                    placeholder="Book Pages" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="remark" 
                    value='<?= isset($book_detail->Remark) ? $book_detail->Remark : '' ?>' 
                    placeholder="Book Remark" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full hover:bg-green-700">Edit</button>
            </form>
        </div>
    </main>
</div>
<?= loadComponent("Tail"); ?>
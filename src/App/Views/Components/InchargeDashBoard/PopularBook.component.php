<div class="bg-l-2 p-6 rounded-lg dark:bg-[#101623] shadow-sm">
    <h2 class="text-xl font-semibold text-l-3 dark:text-d-3 mb-4">Popular Books</h2>
    <p class="text-gray-600 mb-4 dark:text-gray-300">Most checked out books this month</p>
    <ul>
        <?php foreach ($popularBooks as $book): ?>
            <li class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <div>
                        <p class="text-gray-800 font-semibold dark:text-gray-300"><?= htmlspecialchars($book->Title) ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><?= htmlspecialchars($book->Author1) ?></p>
                    </div>
                </div>
                <p class="text-l-3 dark:text-d-3 ml-4">
                    <?= $book->monthly_checkouts ?> checkouts<br>
                    This month
                </p>
            </li>
        <?php endforeach; ?>
        <!-- <li class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <img src="https://placehold.co/50x50" alt="Book cover of Atomic Habits" class="w-12 h-12 mr-4">
                                    <div>
                                        <p class="text-gray-800 font-semibold">Atomic Habits</p>
                                        <p class="text-gray-600">James Clear</p>
                                    </div>
                                </div>
                                <p class="text-l-3 dark:text-d-3">42 checkouts<br>This month</p>
                            </li>
                            <li class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <img src="https://placehold.co/50x50" alt="Book cover of The Silent Patient" class="w-12 h-12 mr-4">
                                    <div>
                                        <p class="text-gray-800 font-semibold">The Silent Patient</p>
                                        <p class="text-gray-600">Alex Michaelides</p>
                                    </div>
                                </div>
                                <p class="text-l-3 dark:text-d-3">38 checkouts<br>This month</p>
                            </li>
                            <li class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <img src="https://placehold.co/50x50" alt="Book cover of Educated" class="w-12 h-12 mr-4">
                                    <div>
                                        <p class="text-gray-800 font-semibold">Educated</p>
                                        <p class="text-gray-600">Tara Westover</p>
                                    </div>
                                </div>
                                <p class="text-l-3 dark:text-d-3">35 checkouts<br>This month</p>
                            </li>
                            <li class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="https://placehold.co/50x50" alt="Book cover of Where the Crawdads Sing" class="w-12 h-12 mr-4">
                                    <div>
                                        <p class="text-gray-800 font-semibold">Where the Crawdads Sing</p>
                                        <p class="text-gray-400">Delia Owens</p>
                                    </div>
                                </div>
                                <p class="text-l-3 dark:text-d-3">31 checkouts<br>This month</p>
                            </li> -->
    </ul>
</div>
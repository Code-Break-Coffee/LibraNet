<div class="bg-l-2 p-6 rounded-lg dark:bg-[#101623] shadow-sm">
    <h2 class="text-xl font-semibold text-l-3 dark:text-d-3 mb-4">Recent Transactions</h2>
    <p class="text-gray-600 mb-4 dark:text-gray-300">Latest book checkouts and returns</p>
    <ul>
        <?php foreach ($recentTransactionBooks as $transaction): ?>
            <li class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <i class="fas fa-book text-l-3 dark:text-d-3 text-2xl mr-4"></i>
                    <div>
                        <p class="text-gray-800 font-semibold dark:text-gray-300"><?= htmlspecialchars($transaction->Title) ?? "" ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><?= htmlspecialchars($transaction->Author1) ?? "" ?></p>
                    </div>
                </div>
                <?php if ($transaction->ReturnDate): ?>
                    <p class="text-green-500">
                        Returned<br>
                        <?= date("F j, g:i:s A", strtotime($transaction->ReturnDate)) ?>
                    </p>
                <?php else: ?>
                    <p class="text-l-3 dark:text-d-3">
                        Issued At<br>
                        <?= date("F j, g:i:s A", strtotime($transaction->BorrowDate)) ?>
                    </p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <!-- <li class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <i class="fas fa-book text-l-3 dark:text-d-3 text-2xl mr-4"></i>
                <div>
                    <p class="text-gray-800 font-semibold">To Kill a Mockingbird</p>
                    <p class="text-gray-600">Michael Johnson</p>
                </div>
            </div>
            <p class="text-green-500">Returned<br>Today, 11:15 AM</p>
        </li>
        <li class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <i class="fas fa-book text-l-3 dark:text-d-3 text-2xl mr-4"></i>
                <div>
                    <p class="text-gray-800 font-semibold">1984</p>
                    <p class="text-gray-600">Sarah Williams</p>
                </div>
            </div>
            <p class="text-l-3 dark:text-d-3">Checked Out<br>Yesterday, 4:45 PM</p>
        </li>
        <li class="flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-book text-l-3 dark:text-d-3 text-2xl mr-4"></i>
                <div>
                    <p class="text-gray-800 font-semibold">The Hobbit</p>
                    <p class="text-gray-600">David Miller</p>
                </div>
            </div>
            <p class="text-green-500">Returned<br>Yesterday, 10:20 AM</p>
        </li> -->
    </ul>
</div>
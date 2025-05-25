<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-l-2 dark:bg-[#101623] p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600">Total Books</h2>
                                <p class="text-3xl font-semibold text-l-3 dark:text-d-3"><?=$books->count ?? 0 ?></p>
                                <!-- <p class="text-green-500">+12 added this month</p> -->
                            </div>
                            <i class="fas fa-book text-l-3 dark:text-d-3 text-2xl"></i>
                        </div>
                    </div>
                    <div class="bg-l-2 dark:bg-[#101623] p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600">Active Members</h2>
                                <p class="text-3xl font-semibold text-l-3 dark:text-d-3"><?=$members->count ?? 0 ?></p>
                                <!-- <p class="text-green-500">+32 new this month</p> -->
                            </div>
                            <i class="fas fa-users text-l-3 dark:text-d-3 text-2xl"></i>
                        </div>
                    </div>
                    <div class="bg-l-2 dark:bg-[#101623] p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600">Books Issued Right Now</h2>
                                <p class="text-3xl font-semibold text-l-3 dark:text-d-3"><?=$issuedBooks->count ?? 0 ?></p>
                                <!-- <p class="text-green-500">+18% from last month</p> -->
                            </div>
                            <i class="fas fa-book-open text-l-3 dark:text-d-3 text-2xl"></i>
                        </div>
                    </div>
                    <div class="bg-l-2 dark:bg-[#101623] p-6 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600">Total Transactions</h2>
                                <p class="text-3xl font-semibold text-green-500"><?=$transactions->count ?? 0 ?></p>
                            </div>
                            <i class="fas fa-clock text-l-3 dark:text-d-3 text-2xl"></i>
                        </div>
                    </div>
                </div>
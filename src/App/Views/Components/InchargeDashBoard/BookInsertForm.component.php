<div class="flex justify-center items-center min-h-[70vh]">
            <form method="POST" action="/incharge-book-insert" class="max-w-lg bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <?=isset($insert_errors) ? loadComponent("ErrorAlert",["errors"=>$insert_errors ?? []]) : ""?>
                <?=isset($success) ? loadComponent("SuccessAlert",["msg" => $success ?? ""]) : ""?>
                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-300">Insert Book</h2>
                <input type="text" name="book_name" 
                    placeholder="Book Name" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>

                <input type="text" name="book_author1" 
                    placeholder="Book Author 1" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="book_author2" 
                    placeholder="Book Author 2" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="book_author3" 
                    placeholder="Book Author 3" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                
                <input type="text" name="edition" 
                    placeholder="Book Edition" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>

                <input type="text" name="publisher" 
                    placeholder="Book Publisher" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                
                <input type="text" name="pages" 
                    placeholder="Book Pages" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                <input type="text" name="remark" 
                    placeholder="Book Remark" 
                    class="w-full mb-2 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"/>
                
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full hover:bg-green-700">Add</button>
            </form>
        </div>
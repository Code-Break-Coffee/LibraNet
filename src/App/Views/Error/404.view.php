<?=loadComponent("Head") ?>
<div class="bg-white dark:bg-[#090A0C]">
    <?php loadComponent("ThemeToggle", ["classes" => "absolute top-2 left-0 w-full"]); ?>
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col items-center justify-center h-screen">
            <img src="Images/404.png" width="400px" height="400px" alt="Error">
            <h1 class="text-4xl font-bold text-gray-700 dark:text-gray-300">404 Not Found</h1>
            <button id="go-back" style="background-color:green" class="btn text-white rounded p-2 mt-3">Go Back</button>
        </div>
</div>
<?=loadComponent("Tail") ?>

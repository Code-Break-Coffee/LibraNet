<?=
loadComponent("Head");
loadComponent("ThemeToggle", ["classes" => "absolute top-3 left-4"]);
?>
<div class="flex min-h-screen items-center justify-center bg-l-1 dark:bg-[#090A0C]">
  <div class="w-full max-w-md rounded-2xl bg-l-2 p-8 shadow-lg border border-[#E0F2FE] dark:bg-[#101623] dark:border-d-2">
    <h2 class="mb-6 text-center text-2xl font-bold text-l-3 dark:text-d-3">
      Sign Up
    </h2>
    <form>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Email
        </label>
        <input
          type="email"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your email" />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Username
        </label>
        <input
          type="text"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your username" />
      </div>
      <div class="mb-4 relative">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Password
        </label>
        <input
          type="password"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your password" />
        <?=loadComponent("EyeIcons") ?>
      </div>
      <div class="mb-4 relative">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Confirm Password
        </label>
        <input
          type="password"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Confirm your password" />
        <?=loadComponent("EyeIconsConfirm") ?>
      </div>
      <button
        type="submit"
        class="w-full rounded-lg bg-l-3 p-3 text-l-7 hover:bg-[#722F37] dark:bg-d-3 dark:hover:bg-l-7 dark:text-[#262424] dark:shadow-lg dark:shadow-d-2/30">
        Sign Up
      </button>
    </form>
    <p class="mt-4 text-center text-sm text-black dark:text-d-3">
      Already Have Account? <a href="/signin" class="text-black dark:text-d-3">Sign in</a>
    </p>
  </div>
</div>
<?=loadComponent("Tail")?>
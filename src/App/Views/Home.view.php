<?php

loadComponent("Head");
?>
<div class="flex min-h-screen items-center justify-center bg-[#EEE5DA] dark:bg-[#3A3A3A]">
  <div class="w-full max-w-md rounded-2xl bg-[#F0E4D0] p-8 shadow-lg border border-[#5A232B] dark:bg-[#262424] dark:border-[#555555]">
    <h2 class="mb-6 text-center text-2xl font-bold text-[#5A232B] dark:text-[#EEE5DA]">
      Sign In
    </h2>
    <form>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-[#5A232B] dark:text-[#EEE5DA]">
          Email
        </label>
        <input
          type="email"
          class="w-full rounded-lg border border-[#5A232B] p-3 focus:border-[#5A232B] focus:outline-none focus:ring-1 focus:ring-[#5A232B] dark:border-[#555555] dark:bg-[#2E2E2E] dark:text-[#EEE5DA] bg-[#FDF6ED]"
          placeholder="Enter your email" />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-[#5A232B] dark:text-[#EEE5DA]">
          Password
        </label>
        <input
          type="password"
          class="w-full rounded-lg border border-[#5A232B] p-3 focus:border-[#5A232B] focus:outline-none focus:ring-1 focus:ring-[#5A232B] dark:border-[#555555] dark:bg-[#2E2E2E] dark:text-[#EEE5DA] bg-[#FDF6ED]"
          placeholder="Enter your password" />
      </div>
      <button
        type="submit"
        class="w-full rounded-lg bg-[#5A232B] p-3 text-[#EEE5DA] hover:bg-[#722F37] dark:bg-[#EEE5DA] dark:hover:bg-[#D9C3A5] dark:text-[#262424] dark:shadow-lg dark:shadow-[#555555]/30">
        Sign In
      </button>
    </form>
    <p class="mt-4 text-center text-sm text-[#5A232B] dark:text-[#EEE5DA]">
      Forgot password? <a href="#" class="text-[#722F37] dark:text-[#EEE5DA]">Reset here</a>
    </p>
  </div>
</div>
<?=
loadComponent("ThemeToggle");
loadComponent("Tail");

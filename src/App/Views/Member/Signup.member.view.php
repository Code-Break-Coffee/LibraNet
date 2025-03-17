<?=
loadComponent("Head");
loadComponent("ThemeToggle", ["classes" => "absolute top-3 left-4"]);
?>
<div class="flex min-h-screen items-center justify-center bg-l-1 dark:bg-[#090A0C]">
  <div class="w-full max-w-md rounded-2xl bg-l-2 p-8 shadow-lg border border-[#E0F2FE] dark:bg-[#101623] dark:border-d-2">
    <?=loadComponent("ErrorAlert",["errors" => $errors ?? []]) ?>
    <?=loadComponent("WarningAlert",["warnings" => $warning ?? []]) ?>
    <h2 class="mb-6 text-center text-2xl font-bold text-l-3 dark:text-d-3">
      Member Sign Up
    </h2>
    <form action=<?=($show_otp_input)? "/add-member": "/member-signup"?> method="POST">
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Email
        </label>
        <input
          type="email"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your email" 
          name="email"
          value="<?=(isset($data["email"])? $data["email"] : "")?>" />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          First name
        </label>
        <input
          type="text"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your first name" 
          name="first_name"
          value="<?=(isset($data["first_name"])? $data["first_name"] : "")?>" />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Middle name
        </label>
        <input
          type="text"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your middle name"
          name="middle_name"
          value="<?=(isset($data["middle_name"])? $data["middle_name"] : "")?>" />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Last name
        </label>
        <input
          type="text"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your last name" 
          name="last_name"
          value="<?=(isset($data["last_name"])? $data["last_name"] : "")?>" />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Phone number
        </label>
        <input
          type="tel"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your phone number" 
          name="phone"
          value="<?=(isset($data["phone"])? $data["phone"] : "")?>"  />
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Address
        </label>
        <textarea
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your address" 
          name="address"><?= isset($data["address"]) ? $data["address"] : "" ?></textarea>
      </div>
      <div class="mb-4 relative">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Password
        </label>
        <input
          type="password"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your password" 
          name="password"
          value="<?=(isset($data["password"])? $data["password"] : "")?>" />
        <?=loadComponent("EyeIcons") ?>
      </div>
      <div class="mb-4 relative">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          Confirm Password
        </label>
        <input
          type="password"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Confirm your password" 
          name="confirm_password"
          value="<?=(isset($data["confirm_password"])? $data["confirm_password"] : "")?>" />
        <?=loadComponent("EyeIconsConfirm") ?>
      </div>
      <?php if($show_otp_input): ?>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-l-3 dark:text-d-3">
          OTP
        </label>
        <input
          type="tel"
          class="w-full rounded-lg border border-l-b-1 p-3 focus:border-l-b-1 focus:outline-none focus:ring-1 focus:ring-l-b-1 dark:border-d-2 dark:bg-l-6 dark:text-d-1 bg-l-5"
          placeholder="Enter your OTP" 
          name="otp" />
      </div>
      <?php endif; ?>
      <?php if($show_otp_input===true): ?>
        <button
          type="submit"
          class=" mt-4 w-full rounded-lg bg-l-3 p-3 text-l-7 hover:bg-[#722F37] dark:bg-d-3 dark:hover:bg-l-7 dark:text-[#262424] dark:shadow-lg dark:shadow-d-2/30">
          Sign Up
        </button>
      <?php else: ?>
        <button
          type="submit"
          class=" mt-4 w-full rounded-lg bg-l-3 p-3 text-l-7 hover:bg-[#722F37] dark:bg-d-3 dark:hover:bg-l-7 dark:text-[#262424] dark:shadow-lg dark:shadow-d-2/30">
          Send OTP
        </button>
      <?php endif; ?>
    </form>
    <p class="mt-4 text-center text-sm text-black dark:text-d-3">
      Already Have Account? <a href="/" class="text-black dark:text-d-3">Sign in</a>
    </p>
  </div>
</div>
<?=loadComponent("Tail")?>
</body>
<script>
    const eye = document.getElementById('eye');
    const eyeSlash = document.getElementById('eye-slash');
    const password = document.querySelector('input[type="password"]');
    const eyeConfirm = document.getElementById('eye-confirm');
    const eyeSlashConfirm = document.getElementById('eye-slash-confirm');
    const passwordConfirm = document.querySelectorAll('input[type="password"]')[1];

    if (eye && eyeSlash && password) {
        eye.addEventListener("click", () => {
            eye.classList.add("hidden");
            eyeSlash.classList.remove("hidden");
            password.type = "password";
        });

        eyeSlash.addEventListener("click", () => {
            eyeSlash.classList.add("hidden");
            eye.classList.remove("hidden");
            password.type = "text";
        });
    }

    if (eyeConfirm && eyeSlashConfirm && passwordConfirm) {
        eyeConfirm.addEventListener("click", () => {
            eyeConfirm.classList.add("hidden");
            eyeSlashConfirm.classList.remove("hidden");
            passwordConfirm.type = "password";
        });

        eyeSlashConfirm.addEventListener("click", () => {
            eyeSlashConfirm.classList.add("hidden");
            eyeConfirm.classList.remove("hidden");
            passwordConfirm.type = "text";
        });
    }

    const telInput = document.querySelector("[type='tel']");
    if (telInput) {
        telInput.addEventListener("input", (e) => {
            const value = e.target.value.replace(/[^0-9]/g, '');
            e.target.value = value;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const drawerToggle = document.querySelector('[data-drawer-toggle]');
        const drawer = document.getElementById(drawerToggle.getAttribute('data-drawer-target'));

        drawerToggle.addEventListener('click', function() {
            drawer.classList.toggle('-translate-x-full');

            // Ensure button stays visible
            this.classList.toggle('z-50');
        });
    });
</script>

</html>
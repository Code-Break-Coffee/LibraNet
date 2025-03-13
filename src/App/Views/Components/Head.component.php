<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?= loadComponent("Tailwind") ?>
    <link rel="stylesheet" href="/css/style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;

            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                html.classList.add('dark');
                themeToggle.checked = true;
            } else {
                html.classList.remove('dark');
                themeToggle.checked = false;
            }

            themeToggle.addEventListener('change', function() {
                if (themeToggle.checked) {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>

</head>

<body>
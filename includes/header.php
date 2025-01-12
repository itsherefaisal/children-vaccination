<?php 

$PATH = '';

if (ROUTE === "index") {
    $PATH = '.';
} else {
    $PATH = '..';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Cares Vaccination</title>
    <link rel="icon" type="image/x-icon" href="<?= $PATH ?>/assets/images/logo.png">

    <script src="<?= $PATH ?>/frameworks/jquery/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        -webkit-text-fill-color: black;
        -webkit-box-shadow: 0 0 0px 1000px transparent inset;
        transition: background-color 5000s ease-in-out 0s;
    }
    </style>
</head>

<body class="bg-gray-100">
    <nav class="bg-[#DDE6ED] text-white px-10 py-4 flex justify-between items-center">
        <a href="<?= $PATH ?>/index.php"
            class="text-xl px-4 pt-1 rounded-md font-bold flex gap-2 items-end justify-center">
            <img src="<?= $PATH ?>/assets/images/logo.png" alt="Logo" class="fluid-responsive size-16">
            <span class="text-md text-bold text-[#66347F] pb-2">Children Vaccination</span>
        </a>

        <div class="hidden md:flex gap-14 items-center">
            <ul class="flex items-center gap-4">
                <li
                    class="py-2 relative before:absolute before:bottom-0 before:left-0 before:bg-[#CB9DF0] before:w-full overflow-hidden before:translate-y-8 before:transition-transform before:duration-300 hover:before:translate-y-0 before:h-1">
                    <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/vaccines.php"
                        class="text-sm text-gray-700 hover:text-gray-950">Vaccines</a>
                </li>
                <li
                    class="py-2 relative before:absolute before:bottom-0 before:left-0 before:bg-[#CB9DF0] before:w-full overflow-hidden before:translate-y-8 before:transition-transform before:duration-300 hover:before:translate-y-0 before:h-1">
                    <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/hospitals.php"
                        class="text-sm text-gray-700 hover:text-gray-950">Hospitals</a>
                </li>
                <li
                    class="py-2 relative before:absolute before:bottom-0 before:left-0 before:bg-[#CB9DF0] before:w-full overflow-hidden before:translate-y-8 before:transition-transform before:duration-300 hover:before:translate-y-0 before:h-1">
                    <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/about.php"
                        class="text-sm text-gray-700 hover:text-gray-950">About us</a>
                </li>
                <li
                    class="py-2 relative before:absolute before:bottom-0 before:left-0 before:bg-[#CB9DF0] before:w-full overflow-hidden before:translate-y-8 before:transition-transform before:duration-300 hover:before:translate-y-0 before:h-1">
                    <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/contact.php"
                        class="text-sm text-gray-700 hover:text-gray-950">Contact us</a>
                </li>
            </ul>
            <div class="flex items-center gap-2 text-white ">
                <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/login.php"
                    class="text-sm text-[#66347F] border-2 border-[#66347F] px-6 py-2 rounded-md transition duration-200 hover:shadow-sm hover:border-[#CDC1FF] hover:bg-[#66347F] hover:text-white <?= ROUTE === 'LOGIN' ? 'bg-[#2E073F]': ' ' ?>">Login</a>
                <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/register.php"
                    class="text-sm text-[#F5EFFF] border-2 border-[#CB9DF0] px-6 py-2 rounded-md transition duration-200 hover:shadow-sm hover:border-[#CDC1FF] hover:text-white <?= ROUTE === 'REGISTER' ? 'bg-[#2E073F]': 'bg-[#66347F]' ?>">Register</a>
            </div>
        </div>

        <button id="mobile-menu-button"
            class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <div id="mobile-menu" class="hidden md:hidden absolute top-16 left-0 w-full bg-[#202040] text-white shadow-lg">
            <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/vaccines.php"
                class="block px-4 py-2 hover:bg-[#2E236C]">Vaccines</a>
            <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/hospitals.php"
                class="block px-4 py-2 hover:bg-[#2E236C]">Hospitals</a>
            <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/login.php"
                class="block px-4 py-2 hover:bg-[#2E236C]">Login</a>
            <a href="<?= $PATH === '.' ? "$PATH/route" : '.' ?>/register.php"
                class="block px-4 py-2 hover:bg-[#2E236C]">Register</a>
        </div>
    </nav>
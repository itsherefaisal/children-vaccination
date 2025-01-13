<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Cares Vaccination</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/logo.png">
    <script src="../../frameworks/jquery/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    .container-main {
        height: calc(100vh - 100px);
    }

    li.active {
        background: #EBD3F8;
    }
    </style>
</head>

<body class="bg-gray-100 overflow-hidden">
    <?php
        define("ROUTE", 'settings');
        require_once('../inc/navbar.php');
    ?>
    <main class="container-main w-full  flex items-center">
        <?php
        require_once('../inc/aside.php');
        ?>
        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-6 overflow-x-hidden overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">Parent Details</h2>
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">First Name</label>
                        <p class="text-gray-800 text-lg font-semibold">John</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Last Name</label>
                        <p class="text-gray-800 text-lg font-semibold">Doe</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Email</label>
                        <p class="text-gray-800 text-lg font-semibold">johndoe@example.com</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Phone Number</label>
                        <p class="text-gray-800 text-lg font-semibold">+1-234-567-890</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Country</label>
                        <p class="text-gray-800 text-lg font-semibold">USA</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">City</label>
                        <p class="text-gray-800 text-lg font-semibold">Springfield</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Address</label>
                        <p class="text-gray-800 text-lg font-semibold">123 Elm Street</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Type</label>
                        <p class="text-gray-800 text-lg font-semibold">Father</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Created At</label>
                        <p class="text-gray-800 text-lg font-semibold">2024-01-12 14:35:00</p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button class="py-2 px-4 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        Edit Details
                    </button>
                </div>
            </div>
        </section>

    </main>

    <!-- <button id="noti-menu-toggle"
                class="size-10 p-2 mr-1 rounded-full bg-[#66347F] border-2 border-gray-300 cursor-pointer transition duration-400 focus:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-[#F5EFFF]" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M20 17H22V19H2V17H4V10C4 5.58172 7.58172 2 12 2C16.4183 2 20 5.58172 20 10V17ZM18 17V10C18 6.68629 15.3137 4 12 4C8.68629 4 6 6.68629 6 10V17H18ZM9 21H15V23H9V21Z">
                    </path>
                </svg>
            </button>
            <button id="profile-menu-toggle"
                class="size-10 p-2 rounded-full bg-[#66347F] border-2 border-gray-300 cursor-pointer transition duration-400 focus:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-[#F5EFFF]" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path>
                </svg>
            </button>
            <div id="profile-menu"
                class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                    Manage Account
                </a>
                <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-100">
                    Logout
                </a>
            </div>
            <div id="noti-menu"
                class="absolute top-full right-0 mt-2 w-[400px] bg-white rounded-lg shadow-lg py-4 hidden">
                <ul class="text-xs text-black py-2 px-4">
                    <li>
                        <h2>Your john doe Appointment Got Approved</h2>
                        <p class="text-end">14/4/2024</p>
                    </li>
                </ul>
            </div>
    <script>
        const profileToggle = document.getElementById("profile-menu-toggle");
        const profileMenu = document.getElementById("profile-menu");
        const notiToggle = document.getElementById("noti-menu-toggle");
        const notiMenu = document.getElementById("noti-menu");

        const toggleMenu = (menu) => {
            menu.classList.toggle("hidden");
        };

        profileToggle.addEventListener("click", () => {
            toggleMenu(profileMenu);
            notiMenu.classList.add("hidden");
        });

        notiToggle.addEventListener("click", () => {
            toggleMenu(notiMenu);
            profileMenu.classList.add("hidden");
        });

        window.addEventListener("click", (e) => {
            if (
                !profileMenu.contains(e.target) &&
                !profileToggle.contains(e.target)
            ) {
                profileMenu.classList.add("hidden");
            }
            if (!notiMenu.contains(e.target) && !notiToggle.contains(e.target)) {
                notiMenu.classList.add("hidden");
            }
        });
    </script> -->
    <script>
            const toggleBtn = document.getElementById('noti-toggle-btn');
    const notiContainer = document.getElementById('noti-container');

    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notiContainer.classList.toggle('hidden');
    });

    document.addEventListener('click', () => {
        if (!notiContainer.classList.contains('hidden')) {
            notiContainer.classList.add('hidden');
        }
    });

    notiContainer.addEventListener('click', (e) => {
        e.stopPropagation();
    });
    </script>
</body>

</html>
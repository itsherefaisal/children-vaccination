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
            <h2 class="text-2xl font-bold mb-6 text-center text-[#66347F]">Hospital Details</h2>
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Hospital ID</label>
                        <p class="text-gray-800 text-lg font-semibold">1</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Name</label>
                        <p class="text-gray-800 text-lg font-semibold">Springfield General Hospital</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Email</label>
                        <p class="text-gray-800 text-lg font-semibold">hospital@example.com</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Contact Number</label>
                        <p class="text-gray-800 text-lg font-semibold">+1-987-654-3210</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Address</label>
                        <p class="text-gray-800 text-lg font-semibold">123 Health Street</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">City</label>
                        <p class="text-gray-800 text-lg font-semibold">Springfield</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">State</label>
                        <p class="text-gray-800 text-lg font-semibold">Illinois</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Country</label>
                        <p class="text-gray-800 text-lg font-semibold">USA</p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Created At</label>
                        <p class="text-gray-800 text-lg font-semibold">2024-01-12 14:35:00</p>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button class="py-2 px-4 bg-purple-500 text-white rounded-lg shadow hover:bg-purple-600">
                        Edit Details
                    </button>
                </div>
            </div>
        </section>


    </main>
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
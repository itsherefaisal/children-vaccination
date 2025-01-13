<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Cares Vaccination</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/logo.png">
    <script src="../../frameworks/jquery/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../frameworks/datatable/datatable.css" />
    <style>
    .container-main {
        height: calc(100vh - 100px);
    }

    li.active {
        background: #EBD3F8;
    }

    aside {
        z-index: 5000;
    }
    </style>
</head>

<body class="bg-gray-100 overflow-hidden">
    <?php
        define("ROUTE", 'children');
        require_once('../inc/navbar.php');
    ?>
    <main class="container-main w-full  flex items-center">
        <?php
        require_once('../inc/aside.php');
    ?>
        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-8 overflow-x-hidden overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6 mt-4 text-center text-purple-600">Children Details</h2>
            <div class="parent-actions w-full flex items-center py-4">
                <button class="py-2 px-4 bg-purple-500 text-gray-200 rounded-xl">
                    Add New Child Details
                </button>
            </div>
            <table id="children-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border border-gray-300 px-4 py-2">Child ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Date of Birth</th>
                        <th class="border border-gray-300 px-4 py-2">Gender</th>
                        <th class="border border-gray-300 px-4 py-2">Vaccination Status</th>
                        <th class="border border-gray-300 px-4 py-2">
                            <p class="text-center">Action</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                        <td class="border border-gray-300 px-4 py-2">Alice Smith</td>
                        <td class="border border-gray-300 px-4 py-2">2015-03-15</td>
                        <td class="border border-gray-300 px-4 py-2">Female</td>
                        <td class="border border-gray-300 px-4 py-2">Up-to-date</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button class="bg-purple-500 text-white px-4 py-1 rounded">EDIT</button>
                            <button class="bg-red-500 text-white px-4 py-1 rounded">DELETE</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">2</td>
                        <td class="border border-gray-300 px-4 py-2">John Doe</td>
                        <td class="border border-gray-300 px-4 py-2">2018-06-21</td>
                        <td class="border border-gray-300 px-4 py-2">Male</td>
                        <td class="border border-gray-300 px-4 py-2">Pending</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button class="bg-purple-500 text-white px-4 py-1 rounded">EDIT</button>
                            <button class="bg-red-500 text-white px-4 py-1 rounded">DELETE</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <script src="../../frameworks/datatable/datatable.js"></script>
    <script defer>
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
    document.addEventListener("DOMContentLoaded", function() {
        const table = new DataTable("#children-details", {
            searchable: true,
            sortable: true,
            fixedHeight: true,
            perPage: 5,
            perPageSelect: [5, 10, 15],
        });
    });
    </script>
</body>

</html>
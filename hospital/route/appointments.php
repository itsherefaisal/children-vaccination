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
        define("ROUTE", 'appointments');
        require_once('../inc/navbar.php');
    ?>
    <main class="container-main w-full  flex items-center">
        <?php
        require_once('../inc/aside.php');
    ?>

<section class="w-full max-w-[1700px] mx-auto h-full bg-white p-8 overflow-x-hidden overflow-y-auto">
    <h2 class="text-2xl font-bold mb-6 mt-10 text-center text-[#66347F]">All Appointments</h2>

    <table id="appointments-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-gray-800">
                <th class="border border-gray-300 px-4 py-2">Appointment ID</th>
                <th class="border border-gray-300 px-4 py-2">Patient Name</th>
                <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                <th class="border border-gray-300 px-4 py-2">Appointment Date</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2">1</td>
                <td class="border border-gray-300 px-4 py-2">Alice Smith</td>
                <td class="border border-gray-300 px-4 py-2">Polio Vaccine</td>
                <td class="border border-gray-300 px-4 py-2">2025-01-15</td>
                <td class="border border-gray-300 px-4 py-2">
                    <select class="border border-gray-300 rounded px-2 py-1 w-full">
                        <option value="Scheduled" selected>Scheduled</option>
                        <option value="Completed">Completed</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">2</td>
                <td class="border border-gray-300 px-4 py-2">John Doe</td>
                <td class="border border-gray-300 px-4 py-2">Hepatitis B Vaccine</td>
                <td class="border border-gray-300 px-4 py-2">2025-01-20</td>
                <td class="border border-gray-300 px-4 py-2">
                    <select class="border border-gray-300 rounded px-2 py-1 w-full">
                        <option value="Scheduled">Scheduled</option>
                        <option value="Completed" selected>Completed</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">3</td>
                <td class="border border-gray-300 px-4 py-2">Emily Johnson</td>
                <td class="border border-gray-300 px-4 py-2">MMR Vaccine</td>
                <td class="border border-gray-300 px-4 py-2">2025-02-05</td>
                <td class="border border-gray-300 px-4 py-2">
                    <select class="border border-gray-300 rounded px-2 py-1 w-full">
                        <option value="Scheduled">Scheduled</option>
                        <option value="Completed">Completed</option>
                        <option value="Pending" selected>Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
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
        const table = new DataTable("#appointments-details", {
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
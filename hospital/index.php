<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Cares Vaccination</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <script src="../frameworks/jquery/jquery.min.js"></script>
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
        define("ROUTE", 'index');
        require_once('./inc/navbar.php');
    ?>

    <main class="container-main w-full  flex items-center">
        <?php
            require_once('./inc/aside.php');
        ?>
        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-6 overflow-x-hidden overflow-y-auto">
            <!-- Latest Vaccines -->
            <div class="vaccines px-8 pb-8 pt-4 bg-zinc-200 rounded-xl mb-6">
                <h1 class="text-2xl font-bold text-[#66347F] mb-4">Latest Vaccines</h1>
                <table class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800">
                            <th class="border border-gray-300 px-4 py-2">Vaccine ID</th>
                            <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                            <th class="border border-gray-300 px-4 py-2">Recommended Age</th>
                            <th class="border border-gray-300 px-4 py-2">Doses Required</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">Polio Vaccine</td>
                            <td class="border border-gray-300 px-4 py-2">Birth</td>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">Available</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">MMR Vaccine</td>
                            <td class="border border-gray-300 px-4 py-2">12-15 Months</td>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">Available</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">3</td>
                            <td class="border border-gray-300 px-4 py-2">Hepatitis B Vaccine</td>
                            <td class="border border-gray-300 px-4 py-2">Birth</td>
                            <td class="border border-gray-300 px-4 py-2">3</td>
                            <td class="border border-gray-300 px-4 py-2">Available</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Latest Appointments -->
            <div class="appointments px-8 pb-8 pt-4 bg-zinc-200 rounded-xl">
                <h1 class="text-2xl font-bold text-[#66347F] mb-4">Latest Appointments</h1>
                <table class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800">
                            <th class="border border-gray-300 px-4 py-2">Appointment ID</th>
                            <th class="border border-gray-300 px-4 py-2">Child Name</th>
                            <th class="border border-gray-300 px-4 py-2">Parent Name</th>
                            <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                            <th class="border border-gray-300 px-4 py-2">Date</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">101</td>
                            <td class="border border-gray-300 px-4 py-2">John Doe Jr.</td>
                            <td class="border border-gray-300 px-4 py-2">John Doe</td>
                            <td class="border border-gray-300 px-4 py-2">Polio Vaccine</td>
                            <td class="border border-gray-300 px-4 py-2">2024-03-15</td>
                            <td class="border border-gray-300 px-4 py-2 text-green-600">Completed</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">102</td>
                            <td class="border border-gray-300 px-4 py-2">Jane Smith Jr.</td>
                            <td class="border border-gray-300 px-4 py-2">Jane Smith</td>
                            <td class="border border-gray-300 px-4 py-2">MMR Vaccine</td>
                            <td class="border border-gray-300 px-4 py-2">2024-03-20</td>
                            <td class="border border-gray-300 px-4 py-2 text-yellow-500">Pending</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">103</td>
                            <td class="border border-gray-300 px-4 py-2">Robert Johnson Jr.</td>
                            <td class="border border-gray-300 px-4 py-2">Robert Johnson</td>
                            <td class="border border-gray-300 px-4 py-2">Hepatitis B Vaccine</td>
                            <td class="border border-gray-300 px-4 py-2">2024-03-25</td>
                            <td class="border border-gray-300 px-4 py-2 text-red-600">Cancelled</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>
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
    </script>
</body>

</html>
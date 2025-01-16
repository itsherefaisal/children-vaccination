<?php 
define("ROUTE", 'index');
require_once("./inc/securityCheck.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Cares Vaccination | Hospital</title>
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
        require_once('./inc/navbar.php');
    ?>

    <main class="container-main w-full  flex items-center">
        <?php
            require_once('./inc/aside.php');
        ?>
        <?php 
        require_once '../config.php';

        $totalUsersQuery = "SELECT COUNT(*) AS total_users FROM parents";
        $totalUsersResult = $conn->query($totalUsersQuery);
        $totalUsers = $totalUsersResult->fetch_assoc()['total_users'] ?? 0;

        $totalHospitalsQuery = "SELECT COUNT(*) AS total_hospitals FROM hospitals";
        $totalHospitalsResult = $conn->query($totalHospitalsQuery);
        $totalHospitals = $totalHospitalsResult->fetch_assoc()['total_hospitals'] ?? 0;

        $latestAppointmentsQuery = "SELECT a.appointment_id, p.first_name AS parent_first_name, p.last_name AS parent_last_name, c.name AS child_name, h.name AS hospital_name, v.name AS vaccine_name, a.appointment_date, a.status
        FROM appointments a
        JOIN parents p ON a.parent_id = p.parent_id
        JOIN children c ON a.child_id = c.child_id
        JOIN hospitals h ON a.hospital_id = h.hospital_id
        JOIN vaccines v ON a.vaccine_id = v.vaccine_id
        ORDER BY a.appointment_date DESC
        LIMIT 5";
        $latestAppointmentsResult = $conn->query($latestAppointmentsQuery);

        $latestVaccinesQuery = "SELECT vaccine_id, name, recommended_age, doses_required, status FROM vaccines ORDER BY created_at DESC LIMIT 5";
        $latestVaccinesResult = $conn->query($latestVaccinesQuery);
        ?>

        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-6 overflow-x-hidden overflow-y-auto">
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-purple-600 text-white p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold">Total Users</h2>
                    <p class="text-3xl font-bold"><?= $totalUsers ?></p>
                </div>
                <div class="bg-blue-600 text-white p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold">Total Hospitals</h2>
                    <p class="text-3xl font-bold"><?= $totalHospitals ?></p>
                </div>
            </div>

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
                        <?php while ($row = $latestVaccinesResult->fetch_assoc()) : ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['vaccine_id']) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?= htmlspecialchars($row['recommended_age']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['doses_required']) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['status']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>


            <div class="appointments px-8 pb-8 pt-4 bg-zinc-200 rounded-xl mb-6">
                <h1 class="text-2xl font-bold text-[#66347F] mb-4">Latest Appointments</h1>
                <table class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800">
                            <th class="border border-gray-300 px-4 py-2">Appointment ID</th>
                            <th class="border border-gray-300 px-4 py-2">Parent Name</th>
                            <th class="border border-gray-300 px-4 py-2">Child Name</th>
                            <th class="border border-gray-300 px-4 py-2">Hospital Name</th>
                            <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                            <th class="border border-gray-300 px-4 py-2">Appointment Date</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $latestAppointmentsResult->fetch_assoc()) : ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['appointment_id']) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?= htmlspecialchars(($row['parent_first_name'] . ' ' . $row['parent_last_name'])) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['child_name']) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['hospital_name']) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['vaccine_name']) ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?= htmlspecialchars($row['appointment_date']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['status']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </section>

        <?php
        $conn->close();
        ?>

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
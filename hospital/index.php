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
        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-6 overflow-x-hidden overflow-y-auto">
            <div class="vaccines px-8 pb-8 pt-4 bg-zinc-200 rounded-xl mb-6">
                <h1 class="text-2xl font-bold text-[#66347F] mb-4">Latest Vaccines</h1>
                <?php
                require_once '../config.php';

                $query = "SELECT vaccine_id, name, recommended_age, doses_required, status FROM vaccines ORDER BY created_at DESC LIMIT 3";
                $result = $conn->query($query);
                ?>

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
                        <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['vaccine_id']) . "</td>
                                <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['name']) . "</td>
                                <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['recommended_age']) . "</td>
                                <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['doses_required']) . "</td>
                                <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['status']) . "</td>
                            </tr>";
                    }
                    ?>
                    </tbody>
                </table>

            </div>

            <div class="appointments px-8 pb-8 pt-4 bg-zinc-200 rounded-xl">
                <h1 class="text-2xl font-bold text-[#66347F] mb-4">Latest Appointments</h1>
                <?php
                        require_once '../config.php';

                        if (!isset($_SESSION['hospital_id'])) {
                            echo "Hospital ID not found.";
                            exit;
                        }

                        $hospital_id = $_SESSION['hospital_id'];
                        $query = "
                            SELECT 
                                a.appointment_id,
                                c.name AS child_name,
                                CONCAT(p.first_name, ' ', p.last_name) AS parent_name,
                                v.name as vaccine_name,
                                a.appointment_date,
                                a.status
                            FROM appointments a
                            JOIN children c ON a.child_id = c.child_id
                            JOIN parents p ON a.parent_id = p.parent_id
                            JOIN vaccines v ON a.vaccine_id = v.vaccine_id
                            WHERE a.hospital_id = ? 
                            ORDER BY a.appointment_date DESC
                            LIMIT 3
                        ";

                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $hospital_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                ?>

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
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                $status_class = '';
                                if ($row['status'] == 'Completed') {
                                    $status_class = 'text-green-600';
                                } elseif ($row['status'] == 'Pending') {
                                    $status_class = 'text-yellow-500';
                                } elseif ($row['status'] == 'Cancelled') {
                                    $status_class = 'text-red-600';
                                }
                            
                                echo "<tr>
                                        <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['appointment_id']) . "</td>
                                        <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['child_name']) . "</td>
                                        <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['parent_name']) . "</td>
                                        <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['vaccine_name']) . "</td>
                                        <td class=\"border border-gray-300 px-4 py-2\">" . htmlspecialchars($row['appointment_date']) . "</td>
                                        <td class=\"border border-gray-300 px-4 py-2 $status_class\">" . htmlspecialchars($row['status']) . "</td>
                                    </tr>";
                            }
                    ?>
                    </tbody>
                </table>

                <?php
                        $stmt->close();
                        $conn->close();
                ?>

            </div>
        </section>
    </main>
    <script src="../frameworks/chartjs/chart.js"></script>
    <script defer>
    async function fetchCovidData() {
        const response = await fetch('https://disease.sh/v3/covid-19/historical/all?lastdays=all');
        const data = await response.json();

        const years = {};
        Object.keys(data.cases).forEach(date => {
            const year = new Date(date).getFullYear();
            if (!years[year]) years[year] = {
                cases: 0,
                deaths: 0,
                recovered: 0
            };

            years[year].cases += data.cases[date];
            years[year].deaths += data.deaths[date];
            years[year].recovered += data.recovered[date];
        });

        return years;
    }

    async function renderCovidChart() {
        const covidData = await fetchCovidData();
        const years = Object.keys(covidData);
        const cases = years.map(year => covidData[year].cases);
        const deaths = years.map(year => covidData[year].deaths);
        const recovered = years.map(year => covidData[year].recovered);

        const ctx = document.getElementById('covidChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                        label: 'Cases',
                        data: cases,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                    {
                        label: 'Deaths',
                        data: deaths,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                    {
                        label: 'Recovered',
                        data: recovered,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Counts'
                        },
                        beginAtZero: true
                    },
                },
            },
        });
    }

    renderCovidChart();

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
<?php 
        define("ROUTE", 'vaccines');
        require_once("../inc/securityCheck.php");

?>

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
        require_once('../inc/navbar.php');
    ?>
    <main class="container-main w-full  flex items-center">
        <?php
        require_once('../inc/aside.php');
    ?>
        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-8 overflow-x-hidden overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6 mt-10 text-center text-purple-600">All Vaccines</h2>
            <table id="vaccines-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
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
                        require_once '../../config.php';

                        $query = "SELECT vaccine_id, name AS vaccine_name, recommended_age, doses_required, status FROM vaccines";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['vaccine_id']) . '</td>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['vaccine_name']) . '</td>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['recommended_age']) . '</td>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['doses_required']) . '</td>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['status']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" class="border border-gray-300 px-4 py-2 text-center">No vaccines found</td></tr>';
                        }
                    
                        $conn->close();
                        ?>
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
        const table = new DataTable("#vaccines-details", {
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
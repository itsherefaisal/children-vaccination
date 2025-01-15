<?php 
        define("ROUTE", 'appointments');
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
            <div class="w-full flex items-center justify-between py-4">
                <h2 class="text-2xl font-bold text-center text-purple-600">Appointment Details</h2>
                <button onclick="window.location.href = './make_appointment.php'"
                    class="py-2 px-4 bg-purple-500 transition hover:bg-purple-600 text-gray-200 rounded-xl">
                    Make Appointment
                </button>
            </div>
            <?php 
            
            require_once '../../config.php';

            $parent_id = $_SESSION['parent_id'];

            $query = "
                SELECT 
                    a.appointment_id, 
                    CONCAT(c.name) AS patient_name,
                    v.name AS vaccine_name,
                    a.appointment_date,
                    a.status
                FROM appointments a
                JOIN children c ON a.child_id = c.child_id
                JOIN vaccines v ON a.vaccine_id = v.vaccine_id
                WHERE c.parent_id = ?
                ORDER BY a.appointment_date ASC
            ";
            
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $parent_id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $null_appointments = null;
            if ($result->num_rows > 0) {
              $null_appointments = false;  
            ?>
            <table id="appointments-details"
                class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border border-gray-300 px-4 py-2">Appointment ID</th>
                        <th class="border border-gray-300 px-4 py-2">Patient Name</th>
                        <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                        <th class="border border-gray-300 px-4 py-2">Appointment Date</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = $result->fetch_assoc()) {
                            $A_ID = $row['appointment_id'];
                            $status = htmlspecialchars($row['status']);
                        
                            echo '<tr>';
                            echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['appointment_id']) . '</td>';
                            echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['patient_name']) . '</td>';
                            echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['vaccine_name']) . '</td>';
                            echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['appointment_date']) . '</td>';
                            echo '<td class="border border-gray-300 px-4 py-2">' . $status . '</td>';
                            echo '<td class="border border-gray-300 px-4 py-2 text-start">';
                        
                            if ($status === 'Completed') {
                                echo "<button onclick='window.location.href = `./view_appointment.php?appointment_id={$A_ID}`' class='bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600'>View</button>";
                            } elseif ($status === 'Pending') {
                                echo "<button onclick='window.location.href = `./edit_appointment.php?appointment_id={$A_ID}`' class='bg-blue-500 mr-2 text-white px-3 py-1 rounded hover:bg-blue-600'>Edit</button>";
                                echo "<button onclick='window.location.href = `./delete_appointment.php?appointment_id={$A_ID}`' class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600'>Cancel</button>";
                            } 
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <?php 
            } else {
                $null_appointments = true;  
                echo '
                <div>
                    <div class="px-4 py-16 text-red-500 text-center">No appointments found</div>
                </div>';
            }
        
            $conn->close();
            ?>
        </section>

    </main>
    <?php 
            if (!$null_appointments) {
                echo '<script src="../../frameworks/datatable/datatable.js"></script>';
            }
        ?>

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
    <?php 
    
    if (!$null_appointments) {
    ?>
    document.addEventListener("DOMContentLoaded", function() {
        const table = new DataTable("#appointments-details", {
            searchable: true,
            sortable: true,
            fixedHeight: true,
            perPage: 5,
            perPageSelect: [5, 10, 15],
        });
    });
    <?php }?>
    </script>
</body>

</html>
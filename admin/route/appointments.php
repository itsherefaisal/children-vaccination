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
                <h2 class="text-2xl font-bold text-center text-purple-600">Appointments</h2>
            </div>

            <?php
    require_once '../../config.php';    

    // Query to fetch all appointments along with hospital, patient, parent, and vaccine details
    $query = "
    SELECT 
        a.appointment_id, 
        CONCAT(c.name) AS patient_name,
        CONCAT(p.first_name, ' ', p.last_name) AS parent_name,
        h.name as hospital_name,
        v.name AS vaccine_name,
        a.appointment_date,
        a.status
    FROM appointments a
    JOIN children c ON a.child_id = c.child_id
    JOIN parents p ON c.parent_id = p.parent_id
    JOIN vaccines v ON a.vaccine_id = v.vaccine_id
    JOIN hospitals h ON a.hospital_id = h.hospital_id
    ORDER BY a.appointment_date ASC
";


    $stmt = $conn->prepare($query);
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
                        <th class="border border-gray-300 px-4 py-2">Hospital Name</th>
                        <th class="border border-gray-300 px-4 py-2">Patient Name</th>
                        <th class="border border-gray-300 px-4 py-2">Parent Name</th>
                        <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                        <th class="border border-gray-300 px-4 py-2">Appointment Date</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($row['appointment_id']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($row['hospital_name']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($row['patient_name']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($row['parent_name']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($row['vaccine_name']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo htmlspecialchars($row['appointment_date']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php if ($row['status'] !== 'Approved') { ?>
                            <button
                                class="status-button bg-purple-500 text-white px-4 py-1 rounded-lg transition hover:bg-purple-600"
                                data-appointment-id="<?php echo $row['appointment_id']; ?>">
                                Approve
                            </button>
                            <?php } else { ?>
                            <span class="text-green-600 font-bold">Approved</span>
                            <?php } ?>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
    } else {
        $null_appointments = true;
        echo '<div><div class="px-4 py-16 text-red-500 text-center">No Appointments Found</div></div>';
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

    $(document).ready(function() {
    $('.status-button').on('click', function() {
        const appointmentId = $(this).data('appointment-id');
        const button = $(this);

        $.ajax({
            url: '../controller/update_appointment_status.controller.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                appointment_id: appointmentId,
                status: 'Approved'
            },
            success: function(response) {
                if (response.status === 'success') {
                    button.replaceWith('<span class="text-green-600 font-bold">Approved</span>');
                } else {
                    alert('An error occurred while updating the status.');
                }
            },
            error: function() {
                alert('An error occurred while updating the status.');
            }
        });
    });
});

    </script>
</body>

</html>
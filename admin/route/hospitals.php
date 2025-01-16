<?php 
        define("ROUTE", 'hospitals');
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
        <h2 class="text-2xl font-bold text-center text-purple-600">All Hospitals</h2>
        <button onclick="window.location.href = './add_hospital.php'"
                class="py-2 px-4 bg-purple-500 transition hover:bg-purple-600 text-gray-200 rounded-xl">
            Add New Hospital
        </button>
    </div>

    <?php
    require_once '../../config.php';    

    $query = "
        SELECT 
            h.hospital_id, 
            h.name AS hospital_name, 
            h.address, 
            h.contact_number,
            h.email
        FROM hospitals h
        ORDER BY h.hospital_id ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $null_hospitals = null;
    
    if ($result->num_rows > 0) {
        $null_hospitals = false;
    ?>
        <table id="hospitals-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-gray-800">
                    <th class="border border-gray-300 px-4 py-2">Hospital ID</th>
                    <th class="border border-gray-300 px-4 py-2">Hospital Name</th>
                    <th class="border border-gray-300 px-4 py-2">Address</th>
                    <th class="border border-gray-300 px-4 py-2">Contact Number</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['hospital_id']); ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['hospital_name']); ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['address']); ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['contact_number']); ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td class="border border-gray-300 px-4 py-2">
                        <button 
                            onclick="window.location.href='./edit_hospital.php?hospital_id=<?php echo $row['hospital_id']; ?>'"
                            class="bg-yellow-500 text-white px-4 py-1 rounded-lg transition hover:bg-yellow-600">
                            Edit
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
    } else {
        $null_hospitals = true;
        echo '<div><div class="px-4 py-16 text-red-500 text-center">No Hospitals Found</div></div>';
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
                        button.replaceWith(
                            '<span class="text-green-600 font-bold">Approved</span>');
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
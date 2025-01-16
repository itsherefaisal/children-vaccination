<?php 
        define("ROUTE", 'appointments.view');
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
    <script>
    $(document).ready(function() {
        let appointment_id = new URLSearchParams(window.location.search).get('appointment_id');
        if (!appointment_id) {
            alert('Invalid Appointment ID');
            window.location.href = 'dashboard.php';
        } else {
            fetchAppointmentDetails(appointment_id);
        }
    });

    function fetchAppointmentDetails(appointment_id) {
        $.ajax({
            url: '../controller/get_appointment.controller.php',
            type: 'GET',
            data: {
                appointment_id: appointment_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#appointment_date').text(response.data.appointment_date);
                    $('#status').text(response.data.status);
                    $('#hospital_name').text(response.data.hospital_name);
                    $('#vaccine_name').text(response.data.vaccine_name);
                    $('#child_name').text(response.data.child_name);
                } else {
                    alert(response.message);
                    window.location.href = 'dashboard.php';
                }
            },
            error: function() {
                alert('Error fetching appointment details');
            }
        });
    }
    </script>
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

        <section
            class="w-full max-w-[1700px] mx-auto h-full bg-white p-8 overflow-x-hidden overflow-y-auto rounded-lg shadow-lg">
            <div class="w-full flex items-center justify-between py-4">
                <h2 class="text-2xl font-bold text-center text-purple-600">Appointment Detail</h2>
            </div>

            <div class="mt-6">
                <p class="text-lg"><strong>Child Name:</strong> <span id="child_name" class="text-gray-700"></span></p>
                <p class="text-lg"><strong>Hospital:</strong> <span id="hospital_name" class="text-gray-700"></span></p>
                <p class="text-lg"><strong>Vaccine:</strong> <span id="vaccine_name" class="text-gray-700"></span></p>
                <p class="text-lg"><strong>Appointment Date:</strong> <span id="appointment_date"
                        class="text-gray-700"></span></p>
                <p class="text-lg"><strong>Status:</strong> <span id="status" class="text-gray-700"></span></p>
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
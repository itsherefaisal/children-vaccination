<?php 
        define("ROUTE", 'children.add');
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
            <h2 class="text-2xl font-bold mb-6 mt-4 text-center text-purple-600">Make Appointment</h2>
            <div class="w-full max mx-auto bg-white shadow-md rounded-lg p-6">
                <?php
                $parent_id = $_SESSION['parent_id'];

                $childrenQuery = $conn->prepare("SELECT child_id, name AS child_name FROM children WHERE parent_id = ?");
                $childrenQuery->bind_param("i", $parent_id);
                $childrenQuery->execute();
                $childrenResult = $childrenQuery->get_result();

                $hospitalsQuery = $conn->prepare("SELECT hospital_id, name AS hospital_name FROM hospitals");
                $hospitalsQuery->execute();
                $hospitalsResult = $hospitalsQuery->get_result();

                $vaccinesQuery = $conn->prepare("SELECT vaccine_id, name AS vaccine_name FROM vaccines");
                $vaccinesQuery->execute();
                $vaccinesResult = $vaccinesQuery->get_result();
                ?>

                <form id="addAppointmentForm" class="space-y-4">
                    <div>
                        <label for="child" class="block text-sm font-medium text-gray-700">Select Child</label>
                        <select id="child" name="child" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                            <option value="" disabled selected>Select Child</option>
                            <?php
                            if ($childrenResult->num_rows > 0) {
                                while ($row = $childrenResult->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['child_id']) . "'>" . htmlspecialchars($row['child_name']) . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No Children Found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="hospital" class="block text-sm font-medium text-gray-700">Select Hospital</label>
                        <select id="hospital" name="hospital" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                            <option value="" disabled selected>Select Hospital</option>
                            <?php
                            if ($hospitalsResult->num_rows > 0) {
                                while ($row = $hospitalsResult->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['hospital_id']) . "'>" . htmlspecialchars($row['hospital_name']) . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No Hospitals Found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="vaccine" class="block text-sm font-medium text-gray-700">Select Vaccine</label>
                        <select id="vaccine" name="vaccine" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                            <option value="" disabled selected>Select Vaccine</option>
                            <?php
                            if ($vaccinesResult->num_rows > 0) {
                                while ($row = $vaccinesResult->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['vaccine_id']) . "'>" . htmlspecialchars($row['vaccine_name']) . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No Vaccines Found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="appointmentDate" class="block text-sm font-medium text-gray-700">Appointment
                            Date</label>
                        <input type="date" id="appointmentDate" name="appointmentDate" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-[#66347F] text-white px-4 py-2 rounded-md shadow-sm hover:bg-[#4E2A60] transition duration-200">
                            Add Appointment
                        </button>
                    </div>
                </form>


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
    $(document).ready(function() {
        $('#addAppointmentForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                child: $('#child').val(),
                hospital: $('#hospital').val(),
                vaccine: $('#vaccine').val(),
                appointmentDate: $('#appointmentDate').val(),
            };

            if (!formData.child || !formData.hospital || !formData.vaccine || !formData
                .appointmentDate) {
                alert('Please fill in all fields before submitting.');
                return;
            }

            $.ajax({
                url: '../controller/make_appointment.controller.php',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = './appointments.php?added_appointment=' +
                            response.appointment_id;
                    } else {
                        alert('Failed to add appointment: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert(
                        'An error occurred while adding the appointment. Please try again.');
                },
            });
        });

    });
    </script>
</body>

</html>
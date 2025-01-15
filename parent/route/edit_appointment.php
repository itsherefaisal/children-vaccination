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
            <h2 class="text-2xl font-bold mb-6 mt-4 text-center text-purple-600">Edit Appointment</h2>
            <div class="w-full max mx-auto bg-white shadow-md rounded-lg p-6">
                <?php
        $appointment_id = $_GET['appointment_id'] ?? null;

        if ($appointment_id) {
            $appointmentQuery = $conn->prepare("
                SELECT 
                    a.child_id, a.hospital_id, a.vaccine_id, a.appointment_date, 
                    c.name AS child_name, 
                    h.name AS hospital_name, 
                    v.name AS vaccine_name 
                FROM appointments a
                JOIN children c ON a.child_id = c.child_id
                JOIN hospitals h ON a.hospital_id = h.hospital_id
                JOIN vaccines v ON a.vaccine_id = v.vaccine_id
                WHERE a.appointment_id = ?
            ");
            $appointmentQuery->bind_param("i", $appointment_id);
            $appointmentQuery->execute();
            $appointmentResult = $appointmentQuery->get_result();
            $appointmentData = $appointmentResult->fetch_assoc();
        }

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

                <form id="editAppointmentForm" method="POST" action="update_appointment.php" class="space-y-4">
                    <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($appointment_id); ?>">

                    <div>
                        <label for="child" class="block text-sm font-medium text-gray-700">Select Child</label>
                        <select id="child" name="child" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                            <option value="" disabled>Select Child</option>
                            <?php
                    if ($childrenResult->num_rows > 0) {
                        while ($row = $childrenResult->fetch_assoc()) {
                            $selected = $row['child_id'] == $appointmentData['child_id'] ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($row['child_id']) . "' $selected>" . htmlspecialchars($row['child_name']) . "</option>";
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
                            class="mt-1 block text-black w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                            <option value="" disabled selected>Select Hospital</option>
                            <?php
                            if ($hospitalsResult->num_rows > 0) {
                                while ($row = $hospitalsResult->fetch_assoc()) {
                                    $selected = $row['hospital_id'] == $appointmentData['hospital_id'] ? 'selected' : '';
                                    echo "<option class='text-black' value='" . htmlspecialchars($row['hospital_id']) . "' $selected>" . htmlspecialchars($row['hospital_name']) . "</option>";
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
                        </select>
                    </div>


                    <div>
                        <label for="appointmentDate" class="block text-sm font-medium text-gray-700">Appointment
                            Date</label>
                        <input type="date" id="appointmentDate" name="appointmentDate" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm"
                            value="<?php echo htmlspecialchars($appointmentData['appointment_date'] ?? ''); ?>">
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-[#66347F] text-white px-4 py-2 rounded-md shadow-sm hover:bg-[#4E2A60] transition duration-200">
                            Update Appointment
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

        $('#hospital').on('change', fetchVaccines);

        function fetchVaccines(hospital_id) {
            const hospitalId = hospital_id ?  hospital_id : $(this).val();

            if (!hospitalId) {
                $('#vaccine').html(
                    '<option value="" disabled selected>Select hospital to fetch vaccines</option>'
                );
                return;
            }

            $.ajax({
                url: '../controller/fetch_vaccines_from_hospital.controller.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    hospital_id: hospitalId
                },
                success: function(response) {
                    if (!response || !response.status) {
                        $('#vaccine').html(
                            '<option value="" disabled>Invalid response from server</option>'
                        );
                        return;
                    }

                    switch (response.status) {
                        case 'success':
                            $('#vaccine').html(
                                '<option value="" disabled selected>Select Vaccine</option>'
                            );
                            response.data.forEach(vaccine => {
                                const optionText = vaccine.out_of_stock ?
                                    `${vaccine.name} - Out of Stock` :
                                    vaccine.name;
                                const disabledAttr = vaccine.out_of_stock ?
                                    'disabled' : '';
                                $('#vaccine').append(
                                    `<option value="${vaccine.vaccine_id}" ${disabledAttr}>${optionText}</option>`
                                );
                            });

                            const currentVaccineId = $('#vaccine').data(
                                'selected-vaccine-id');
                            if (currentVaccineId) {
                                $('#vaccine').val(currentVaccineId)
                            .change();
                            }

                            break;

                        case 'error':
                            $('#vaccine').html('<option value="" disabled>' + response
                                .message + '</option>');
                            break;

                        default:
                            $('#vaccine').html(
                                '<option value="" disabled>Unexpected response status</option>'
                            );
                    }
                },
                error: function() {
                    $('#vaccine').html(
                        '<option value="" disabled>Error fetching vaccines. Please try again later.</option>'
                    );
                }
            });
        }
        let h_id = $('#hospital').val();
        $('#editAppointmentForm').on('submit', function(e) {
            e.preventDefault();
            h_id
            const formData = {
                appointment_id: '<?php echo $appointment_id; ?>',
                child: $('#child').val(),
                hospital: $('#hospital').val(),
                vaccine: $('#vaccine').val(),
                appointmentDate: $('#appointmentDate').val(),
            };

            $.ajax({
                url: '../controller/update_appointment.controller.php',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = './appointments.php';
                    } else {
                        alert('Failed to update appointment: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while updating the appointment.');
                },
            });
        });

        fetchVaccines(h_id);
        const selectedVaccineId = "<?php echo htmlspecialchars($appointmentData['vaccine_id'] ?? ''); ?>";
        $('#vaccine').data('selected-vaccine-id', selectedVaccineId);

    });
    </script>
</body>

</html>
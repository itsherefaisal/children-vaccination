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
            <div class="w-full flex items-center justify-between py-4">
                <h2 class="text-2xl font-bold text-center text-purple-600">Available Vaccines</h2>
                <button onclick="window.location.href = './make_appointment.php'"
                    class="py-2 px-4 bg-purple-500 transition hover:bg-purple-600 text-gray-200 rounded-xl">
                    Add Vaccine
                </button>
            </div>
            <table id="vaccines-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border border-gray-300 px-4 py-2">Vaccine ID</th>
                        <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                        <th class="border border-gray-300 px-4 py-2">Recommended Age</th>
                        <th class="border border-gray-300 px-4 py-2">Doses Required</th>
                        <th class="border border-gray-300 px-4 py-2">Stock Available</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Stock Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../../config.php';    
                        $hospital_id = $_SESSION['hospital_id'];    

                        $query = "
                            SELECT 
                                v.vaccine_id, 
                                v.name AS vaccine_name, 
                                v.recommended_age, 
                                v.doses_required, 
                                hv.stock_available, 
                                v.status
                            FROM vaccines v
                            JOIN hospital_vaccines hv ON v.vaccine_id = hv.vaccine_id
                            WHERE hv.hospital_id = ?
                            ORDER BY v.name ASC
                        ";  

                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $hospital_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['vaccine_id']); ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?php echo htmlspecialchars($row['vaccine_name']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?php echo htmlspecialchars($row['recommended_age']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?php echo htmlspecialchars($row['doses_required']); ?></td>
                            <td class="border border-gray-300 px-4 py-2 stock-available-<?= $row['vaccine_id'];?>">
                                <?php echo htmlspecialchars($row['stock_available']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button class="p-1 bg-blue-500 text-white rounded-full hover:bg-blue-600 increase-stock"
                                    data-vaccine-id="<?php echo $row['vaccine_id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                                    </svg>
                                </button>
                                <button class="p-1 bg-red-500 text-white rounded-full hover:bg-red-600 decrease-stock"
                                    data-vaccine-id="<?php echo $row['vaccine_id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path d="M5 11V13H19V11H5Z"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php 
                            }
                        } else {
                            echo '<tr><td colspan="7" class="px-4 py-2 text-center text-red-500">No vaccines available for this hospital</td></tr>';
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

    $(document).ready(function() {
        $(".increase-stock").click(function() {
            var vaccineId = $(this).data('vaccine-id');
            updateStock(vaccineId, 'increase');
        });

        $(".decrease-stock").click(function() {
            var vaccineId = $(this).data('vaccine-id');
            updateStock(vaccineId, 'decrease');
        });

        function updateStock(vaccineId, action) {
            $.ajax({
                url: '../controller/update_stock.controller.php',
                method: 'POST',
                data: {
                    vaccine_id: vaccineId,
                    action: action
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        var currentStock = $(".stock-available-" + vaccineId).text();
                        var newStock = action === 'increase' ? parseInt(currentStock) + 1 :
                            parseInt(currentStock) - 1;
                        $(".stock-available-" + vaccineId).text(newStock);
                    } else {
                        alert(data.message);
                    }
                },
                error: function() {
                    alert("Error updating stock.");
                }
            });
        }
    });
    </script>
</body>

</html>
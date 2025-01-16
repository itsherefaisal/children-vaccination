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
                <h2 class="text-2xl font-bold text-center text-purple-600">All Vaccines</h2>
                <button onclick="window.location.href = './add_vaccine.php'"
                    class="py-2 px-4 bg-purple-500 transition hover:bg-purple-600 text-gray-200 rounded-xl">
                    Add Vaccine
                </button>
            </div>
            <?php 
            if (isset($_GET['message'])) {
            ?>
            <div class="w-full flex items-center justify-center py-4">
                <p class="text-xl font-bold text-green-600"><?= $_GET['message']?></p>
            </div>
            <?php 
        }
        ?>
            <?php
    require_once '../../config.php';

    $query = "
        SELECT 
            vaccine_id, 
            name AS vaccine_name, 
            recommended_age, 
            doses_required, 
            status
        FROM vaccines
        ORDER BY name ASC
    ";  

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $count_vaccines = null;

    if ($result->num_rows > 0) {
        $count_vaccines = false;
    ?>
            <table id="vaccines-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border border-gray-300 px-4 py-2">Vaccine ID</th>
                        <th class="border border-gray-300 px-4 py-2">Vaccine Name</th>
                        <th class="border border-gray-300 px-4 py-2">Recommended Age</th>
                        <th class="border border-gray-300 px-4 py-2">Doses Required</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['status']); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button
                                onclick="window.location.href = './edit_vaccine.php?vaccine_id=<?php echo $row['vaccine_id']; ?>'"
                                class="p-1 px-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Edit
                            </button>

                            <button 
                                onclick="window.location.href = '../controller/delete_vaccine.controller.php?vaccine_id=<?php echo $row['vaccine_id']; ?>'"
                                class="p-1 px-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php 
                }
                ?>
                </tbody>
            </table>
            <?php 
    } else {
        $count_vaccines = true;
        echo '<div><h2 class="px-4 py-2 text-center text-lg text-red-500">No vaccines available</h2></div>';
    }
    $conn->close();
    ?>

        </section>



    </main>
    <?php 
    if (!$count_vaccines) {
    ?>
    <script src="../../frameworks/datatable/datatable.js"></script>
    <?php
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
if (!$count_vaccines) {
    ?>
    document.addEventListener("DOMContentLoaded", function() {
        const table = new DataTable("#vaccines-details", {
            searchable: true,
            sortable: true,
            fixedHeight: true,
            perPage: 5,
            perPageSelect: [5, 10, 15],
        });
    });
    <?php
}

?>


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
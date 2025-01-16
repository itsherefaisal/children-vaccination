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
    <h2 class="text-2xl font-bold mb-6 mt-4 text-center text-purple-600">Add New Vaccine</h2>
    <div class="w-full max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <form id="addVaccineForm" class="space-y-4" action="../controller/add_vaccine.controller.php" method="POST">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Vaccine Name</label>
                <input type="text" id="name" name="name" required 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-black">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Vaccine Description</label>
                <textarea id="description" name="description" rows="4" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-black"></textarea>
            </div>

            <div>
                <label for="doses_required" class="block text-sm font-medium text-gray-700">Doses Required</label>
                <input type="number" id="doses_required" name="doses_required" min="1" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-black">
            </div>

            <div>
                <label for="recommended_age" class="block text-sm font-medium text-gray-700">Recommended Age</label>
                <input type="text" id="recommended_age" name="recommended_age" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-black">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-black">
                    <option value="" disabled selected>Select Status</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-purple-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-purple-700 transition duration-200">
                    Add Vaccine
                </button>
            </div>
        </form>
    </div>
</section>

<?php
// Close the database connection
$conn->close();
?>


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
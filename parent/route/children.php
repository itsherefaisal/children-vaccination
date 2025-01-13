<?php 
        define("ROUTE", 'children');
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
            <?php 
            if (isset($_GET['updated_child']) && isset($_GET['prev_name'])) {            
            ?>
            <div class="w-full px-8 py-4 bg-blue-400">
                <h3 class="text-green-200">You Just Child Details Named <?= $_GET['prev_name']?> To
                    <?= $_GET['updated_child']?></h3>
            </div>
            <?php 
            }
            if (isset($_GET['added_child'])) {
            
            ?>
            <div class="w-full px-8 py-4 bg-green-400">
                <h3 class="text-purple-800">You Just Added New Child Details Named : <?= $_GET['added_child']?></h3>
            </div>
            <?php 
            }
            if (isset($_GET['deleted_child'])) {
            ?>
            <div class="w-full px-8 py-4 bg-red-500">
                <h3 class="text-purple-200">You Just Deleted Child Details Named : <?= $_GET['deleted_child']?></h3>
            </div>
            <?php 
            }
            ?>

            <div class="parent-actions w-full flex items-center justify-between py-4">
                <h2 class="text-2xl font-bold text-center text-purple-600">Children Details</h2>
                <button onclick="window.location.href = './add_child.php'"
                    class="py-2 px-4 bg-purple-500 transition hover:bg-purple-600 text-gray-200 rounded-xl">
                    New Child
                </button>
            </div>
            <?php 
            
            $parent_id = $_SESSION['parent_id'];

            $sql = "SELECT child_id, name, dob, gender, vaccination_status FROM children WHERE parent_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $parent_id);
        
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    
            ?>
            <table id="children-details" class="min-w-full bg-white table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="border border-gray-300 px-4 py-2">Child ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Date of Birth</th>
                        <th class="border border-gray-300 px-4 py-2">Gender</th>
                        <th class="border border-gray-300 px-4 py-2">Vaccination Status</th>
                        <th class="border border-gray-300 px-4 py-2">
                            <p class="text-center">Action</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $index = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td class='border border-gray-300 px-4 py-2'>{$index}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['name']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['dob']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['gender']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['vaccination_status']}</td>
                            <td class='border border-gray-300 px-4 py-2 text-center'>
                                <button class='bg-purple-500 text-white px-4 py-1 rounded' onclick='window.location.href = `./edit_child.php?child_id={$row['child_id']}`'>EDIT</button>
                                <button class='bg-red-500 text-white px-4 py-1 rounded' onclick='window.location.href = `./delete_child.php?child_id={$row['child_id']}`'>DELETE</button>
                            </td>
                        </tr>";
                        $index++;
                    }
                ?>
                </tbody>
            </table>
            <?php 
                } else {
                    echo "
                    <div>
                        <div class='py-20 text-lg text-red-500 text-center'>No children found.</div>
                    </div>";
                }
            
                $stmt->close();
            } else {
                echo "Error: Failed to prepare the SQL statement.";
            }
            ?>
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
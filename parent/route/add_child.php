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
            <h2 class="text-2xl font-bold mb-6 mt-4 text-center text-purple-600">Add Child Details</h2>
            <div class="w-full max mx-auto bg-white shadow-md rounded-lg p-6">
                <form id="addChildForm" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Child Name</label>
                        <input type="text" id="name" name="name" autocomplete="off" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                    </div>

                    <div>
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select id="gender" name="gender" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#66347F] focus:border-[#66347F] sm:text-sm">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-[#66347F] text-white px-4 py-2 rounded-md shadow-sm hover:bg-[#4E2A60] transition duration-200">
                            Add Child
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
        $('#addChildForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: $('#name').val(),
                dob: $('#dob').val(),
                gender: $('#gender').val(),
            };

            $.ajax({
                url: '../controller/add_child.controller.php',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = `./children.php?added_child=${formData.name}`;
                        $('#addChildForm')[0].reset();
                    } else {
                        alert('Failed to add child: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while adding the child.');
                },
            });
        });
    });
    </script>
</body>

</html>
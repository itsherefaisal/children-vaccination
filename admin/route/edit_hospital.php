<?php 
        define("ROUTE", 'hospital.edit');
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
    <style>
    .container-main {
        height: calc(100vh - 100px);
    }

    li.active {
        background: #EBD3F8;
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
<section class="w-full max-w-[1700px] mx-auto h-full bg-white p-6 overflow-x-hidden overflow-y-auto">
    <div class="w-full flex items-center justify-between py-4">
        <h2 class="text-2xl font-bold text-center text-purple-600">Edit Hospital Details</h2>
    </div>
    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
        <?php
        require_once '../../config.php';
        
        $hospital_id = $_GET['hospital_id'];
        $query = $conn->prepare("SELECT name, contact_number AS phone, email, address, country, city, state FROM hospitals WHERE hospital_id = ?");
        $query->bind_param("i", $hospital_id);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
            <form action="../controller/update_hospital_details.controller.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <input type="hidden" name="hospital_id" value="<?php echo htmlspecialchars($hospital_id); ?>">

                <div class="flex flex-col">
                    <label for="name" class="text-gray-600 font-medium mb-2">Hospital Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="email" class="text-gray-600 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="phone" class="text-gray-600 font-medium mb-2">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="country" class="text-gray-600 font-medium mb-2">Country</label>
                    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($row['country']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="state" class="text-gray-600 font-medium mb-2">State</label>
                    <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($row['state']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="city" class="text-gray-600 font-medium mb-2">City</label>
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($row['city']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="address" class="text-gray-600 font-medium mb-2">Address</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" class="border border-gray-300 rounded p-2" required>
                </div>

                <div class="flex flex-col">
                    <label for="password" class="text-gray-600 font-medium mb-2">Password (Leave blank to keep unchanged)</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 rounded p-2">
                </div>

                <div class="col-span-1 md:col-span-2 lg:col-span-3 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Changes</button>
                </div>
            </form>
        <?php
        } else {
            echo "<p class='text-gray-800 text-lg font-semibold'>No data found for the hospital.</p>";
        }
        ?>
    </div>
</section>


    </main>

    <script>
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
<?php 
        define("ROUTE", 'settings');
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
                <h2 class="text-2xl font-bold text-center text-purple-600">Personal Details</h2>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <?php
                    require_once '../../config.php';

                    $user_id = $_SESSION['parent_id'];
                    $query = $conn->prepare("SELECT first_name, last_name, email, phone_number as phone, country, city, address, type, created_at FROM parents WHERE parent_id = ?");
                    $query->bind_param("i", $user_id);
                    $query->execute();
                    $result = $query->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">First Name</label>
                        <p class="text-gray-800 text-lg font-semibold">
                            <?php echo htmlspecialchars($row['first_name']); ?></p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Last Name</label>
                        <p class="text-gray-800 text-lg font-semibold">
                            <?php echo htmlspecialchars($row['last_name']); ?></p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Email</label>
                        <p class="text-gray-800 text-lg font-semibold"><?php echo htmlspecialchars($row['email']); ?>
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Phone Number</label>
                        <p class="text-gray-800 text-lg font-semibold"><?php echo htmlspecialchars($row['phone']); ?>
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Country</label>
                        <p class="text-gray-800 text-lg font-semibold"><?php echo htmlspecialchars($row['country']); ?>
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">City</label>
                        <p class="text-gray-800 text-lg font-semibold"><?php echo htmlspecialchars($row['city']); ?></p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Address</label>
                        <p class="text-gray-800 text-lg font-semibold"><?php echo htmlspecialchars($row['address']); ?>
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Type</label>
                        <p class="text-gray-800 text-lg font-semibold"><?php echo htmlspecialchars($row['type']); ?></p>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-600 font-medium mb-2">Created At</label>
                        <p class="text-gray-800 text-lg font-semibold">
                            <?php echo htmlspecialchars($row['created_at']); ?></p>
                    </div>
                </div>
                <?php
                    } else {
                        echo "<p class='text-gray-800 text-lg font-semibold'>No data found for the user.</p>";
                    }
                ?>

                <div class="flex justify-end mt-6">
                    <button onclick="window.location.href = './edit_personal.php'" class="py-2 px-4 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        Edit Details
                    </button>
                </div>
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
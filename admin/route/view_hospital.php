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
<?php
include_once("../../config.php");

$hospital_id = $_GET['hospital_id'] ?? '';

$query = "SELECT * FROM hospitals WHERE hospital_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$result = $stmt->get_result();
$hospital = $result->fetch_assoc();

$conn->close();
?>

<section class="w-full max-w-[1700px] mx-auto h-full bg-white p-8 overflow-x-hidden overflow-y-auto shadow-lg rounded-lg">
        <div class="w-full flex items-center justify-between py-4">
            <h2 class="text-2xl font-bold text-purple-600">Hospital Details</h2>
        </div>

        <?php if ($hospital): ?>
            <div class="w-full bg-gray-50 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($hospital['name']) ?></h3>
                
                <div class="mt-4">
                    <p class="text-sm"><span class="font-semibold">Email:</span> <?= htmlspecialchars($hospital['email']) ?></p>
                    <p class="text-sm"><span class="font-semibold">Contact:</span> <?= htmlspecialchars($hospital['contact_number']) ?></p>
                    <p class="text-sm"><span class="font-semibold">Address:</span> <?= htmlspecialchars($hospital['address']) ?></p>
                    <p class="text-sm"><span class="font-semibold">City:</span> <?= htmlspecialchars($hospital['city']) ?></p>
                    <p class="text-sm"><span class="font-semibold">State:</span> <?= htmlspecialchars($hospital['state']) ?></p>
                    <p class="text-sm"><span class="font-semibold">Country:</span> <?= htmlspecialchars($hospital['country']) ?></p>
                    <p class="text-sm"><span class="font-semibold">Registered On:</span> <?= htmlspecialchars($hospital['created_at']) ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="text-red-500 text-center text-lg font-semibold mt-8">Hospital not found</div>
        <?php endif; ?>

        <div class="mt-6">
            <a href="../index.php" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Back to Home</a>
        </div>
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
    </script>
</body>

</html>
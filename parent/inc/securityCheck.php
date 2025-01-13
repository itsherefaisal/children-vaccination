<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['parent_id']) && !isset($_SESSION['parent_email'])) {
?>
<script src="https://cdn.tailwindcss.com"></script>
<section class="grid h-screen place-content-center bg-white px-4">
    <div class="text-center">
        <h1 class="text-9xl font-black text-gray-200">401</h1>

        <p class="text-2xl font-bold tracking-tight text-red-600 sm:text-4xl">Access denied!</p>

        <p class="mt-4 text-gray-500">You dont have permission to access this page.</p>

        <a href="<?= ROUTE === 'index' ? '../index.php' : '../../index.php'?>"
            class="mt-4 inline-block rounded bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring">
            Go Back Home
        </a>
    </div>
</section>
<?php
    exit;
} else {
    
    $PATH = ROUTE === 'index' ? '../config.php' : '../../config.php';
    
    include_once($PATH);
    $parent_id = $_SESSION['parent_id'];

    $sql = "SELECT * FROM parents WHERE parent_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $parent_id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            $PARENT_FIRST = $user['first_name'];
            $PARENT_LAST = $user['last_name'];
            $PARENT_EMAIL = $user['email'];

        } else {
            echo "User not found.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }

}
?>
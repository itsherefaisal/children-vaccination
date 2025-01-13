<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['parent_id']) && isset($_SESSION['parent_email'])) {
    ?>
<section class="w-full flex items-center justify-center h-screen">
    <h1 class="text-red-600 text-3xl">USER ALREADY LOGGED-IN</h1>
</section>
<?php
    exit;
}
?>
<?php
    define("ROUTE", 'index');
    require_once('./includes/header.php');
?>




<?php
    require_once('./includes/footer.php');
?>

<script>
document.getElementById("mobile-menu-button").addEventListener("click", () => {
    const menu = document.getElementById("mobile-menu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
});
</script>
</body>

</html>
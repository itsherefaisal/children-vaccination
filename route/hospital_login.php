<?php
    define("ROUTE", 'LOGIN');
    require_once('../includes/header.php');
    require_once('../includes/redirectSafety.php');
?>

<section class="min-h-[90vh] py-10 rounded-lg flex items-center justify-center w-full"
    style="background-image: url('../assets/images/bg-minimalist-background-blur.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="max-w-2xl w-[400px] bg-white pt-14 pb-4 rounded-lg">
        <h2 class="text-center text-xl text-[#66347F] font-bold">LOGIN YOUR HOSPITAL ACCOUNT</h2>

        <form id="login-form" class="space-y-3 p-8">
            <div>
                <label for="Email"
                    class="relative block py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="email" id="Email" name="email" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Email" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Email
                    </span>
                </label>
            </div>

            <div>
                <label for="Password"
                    class="relative block py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="password" id="Password" name="password" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Password" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Password
                    </span>
                </label>
            </div>
            <div class="other-log">
                <a href="./login.php" class="text-xs pl-2 text-red-500 font-bold">Login as Parent</a>
            </div>
            <div class="flex items-center justify-end px-2">
                <button
                    class="text-sm text-[#F5EFFF] font-medium bg-[#66347F] border-2 border-gray-300 px-6 py-2 rounded-md transition duration-200 hover:shadow-sm hover:border-[#CDC1FF] hover:text-white"
                    type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>
</section>

<?php
    require_once('../includes/footer.php');
?>
<script>
function showModal(message) {
    const modalHtml = `
                <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white p-6 rounded-md shadow-lg max-w-sm w-full">
                        <h2 class="text-lg font-bold text-red-600 mb-4">Error</h2>
                        <p class="text-sm text-gray-700 mb-6">${message}</p>
                        <button class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="closeModal()">Close</button>
                    </div>
                </div>`;
    $('body').append(modalHtml);
}

function closeModal() {
    $('#errorModal').remove();
}
$(document).ready(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault();

        const formData = {
            email: $('#Email').val(),
            password: $('#Password').val()
        };

        $.ajax({
            url: '../controller/login_hospital.controller.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    window.location.href = '../index.php';
                } else {
                    showModal(response.message);
                }
            },
            error: function() {
                showModal('An error occurred while processing your request.');
            }
        });
    });
});
</script>
</body>

</html>
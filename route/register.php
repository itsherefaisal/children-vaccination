<?php
    define("ROUTE", 'REGISTER');
    require_once('../includes/header.php');
    require_once('../includes/redirectSafety.php');
?>

<section class="min-h-[90vh] py-16 rounded-lg flex items-center justify-center w-full"
    style="background-image: url('../assets/images/bg-minimalist-background-blur.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="max-w-2xl w-[700px] bg-white pt-14 pb-4 rounded-lg">
        <div id="error-modal" class="modal" style="display: none;">
            <div class="modal-content bg-red-200 rounded-xl border-4 flex flex-col border-red-400">
                <div class="closee w-full flex items-center justify-end">
                    <span class="close flex items-center justify-center rounded-full p-1 group hover:bg-red-400"
                        onclick="closeModal()"><svg xmlns="http://www.w3.org/2000/svg"
                            class="text-red-700 group-hover:text-red-900 size-6" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M10.5859 12L2.79297 4.20706L4.20718 2.79285L12.0001 10.5857L19.793 2.79285L21.2072 4.20706L13.4143 12L21.2072 19.7928L19.793 21.2071L12.0001 13.4142L4.20718 21.2071L2.79297 19.7928L10.5859 12Z">
                            </path>
                        </svg></span>
                </div>
                <h2 id="modal-title">Error</h2>
                <p id="modal-message">Something went wrong.</p>
            </div>
        </div>


        <h2 class="text-center text-xl text-[#66347F] font-bold">REGISTER YOUR PARENT ACCOUNT</h2>
        <form id="register-form" class="space-y-3 p-8">
            <div class="flex items-center w-full gap-2 justify-center">
                <label for="Firstname"
                    class="relative block w-full py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="text" id="Firstname" name="first_name" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="First Name" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        First Name
                    </span>
                </label>
                <label for="Lastname"
                    class="relative block w-full py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="text" id="Lastname" name="last_name" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Last Name" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Last Name
                    </span>
                </label>
            </div>

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
            <div>
                <label for="Password"
                    class="relative block py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="password" id="confirmPassword" name="confirm_password" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Confirm Password" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Confirm Passowrd
                    </span>
                </label>
            </div>
            <div class="flex items-center w-full gap-2 justify-center">
                <label for="Country"
                    class="relative block w-full py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="text" id="Country" name="country" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Country" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Country
                    </span>
                </label>
                <label for="City"
                    class="relative block w-full py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="text" id="City" name="city" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="City" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        City
                    </span>
                </label>
            </div>

            <div>
                <label for="Address"
                    class="relative block rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <textarea id="Address" name="address" rows="3" required
                        class="peer border-none w-full py-2 px-2 text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Address"></textarea>
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Address
                    </span>
                </label>
            </div>

            <div>
                <label for="PhoneNumber"
                    class="relative block py-2 px-2 rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <input type="text" id="PhoneNumber" name="phone_number" required
                        class="peer border-none w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                        placeholder="Phone Number" />
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        Phone Number
                    </span>
                </label>
            </div>

            <div>
                <label for="Type"
                    class="relative block rounded-md border-2 border-gray-300 shadow-sm focus-within:border-blue-600 transition-focus duration-200 focus-within:ring-1 focus-within:ring-blue-600">
                    <select id="Type" name="type" required
                        class="peer border-none py-3 px-2 w-full text-xs bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0">
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                    </select>
                    <span
                        class="pointer-events-none absolute text-xs md:text-xs start-2.5 top-0 -translate-y-1/2 bg-white p-0.5 text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs">
                        I am a
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end px-2">
                <button
                    class="text-sm text-[#F5EFFF] font-medium bg-[#66347F] border-2 border-gray-300 px-6 py-2 rounded-md transition duration-200 hover:shadow-sm hover:border-[#CDC1FF] hover:text-white"
                    type="submit">
                    Register now
                </button>
            </div>
        </form>
    </div>
</section>
<?php
    require_once('../includes/footer.php');
?>

<script>
function showModal(title, message) {
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const modal = document.getElementById('error-modal');

    modalTitle.textContent = title;
    modalMessage.textContent = message;

    modal.style.display =
        'block';
}

function closeModal() {
    const modal = document.getElementById('error-modal');
    modal.style.display =
        'none';
}
$(document).ready(function() {


    $('#register-form').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '../controller/register.controller.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                const res = JSON.parse(response);

                if (res.status === 'success') {
                    const emailValue = $('#Email').val();
                    window.location.href = ("./login.php?register_success=" + emailValue);
                    $('#register-form')[0].reset();
                } else if (res.status === 'error' && res.errors && Array.isArray(res
                        .errors)) {
                    res.errors.forEach(error => {
                        switch (error.code) {
                            case 1001:
                                showModal('First Name Error', error.message);
                                break;
                            case 1002:
                                showModal('Last Name Error', error.message);
                                break;
                            case 1003:
                                showModal('Email Error', error.message);
                                break;
                            case 1004:
                                showModal('Password Error', error.message);
                                break;
                            case 1005:
                                showModal('Confirm Password Error', error.message);
                                break;
                            case 1006:
                                showModal('Country Error', error.message);
                                break;
                            case 1007:
                                showModal('City Error', error.message);
                                break;
                            case 1008:
                                showModal('Address Error', error.message);
                                break;
                            case 1009:
                                showModal('Phone Number Error', error.message);
                                break;
                            case 1010:
                                showModal('Type Error', error.message);
                                break;
                            case 1011:
                                showModal('Duplicate Email Error', error.message);
                                break;
                            case 1012:
                                showModal('Registration Error', error.message);
                                break;
                            default:
                                showModal('Unknown Error',
                                    'An unknown error occurred. Please try again.'
                                );
                        }
                    });
                } else {
                    showModal('General Error',
                        'An error occurred. Please try again later.');
                }

            },
            error: function(xhr, status, error) {
                showModal('An unexpected error occurred. Please try again later.');
            },
        });
    });
});
</script>
</body>

</html>
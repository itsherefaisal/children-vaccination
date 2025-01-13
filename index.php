<?php
    define("ROUTE", 'index');
    require_once('./includes/header.php');
?>

<section class="w-full max-w-[1700px] relative mx-auto overflow-hidden shadow-lg slider-container">
    <div id="contentSlider" class="flex transition-transform duration-500 ease-in-out">
        <div id="slideWelcome"
            class="slide flex-none w-full bg-cover bg-center flex items-center h-[600px] text-white py-24 px-10 relative"
            style="background-image: url(./assets/images/vaccination-safe.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <div class="content-wrapper md:w-1/2 z-30">
                <p class="slide-title font-bold text-sm uppercase">Welcome</p>
                <p class="slide-heading text-3xl font-bold">Streamline Your Child's Vaccination Journey</p>
                <p class="slide-subheading text-sm mb-10 leading-none">
                    Simplifying vaccination scheduling and record-keeping for parents and healthcare providers
                    alike.
                </p>
            </div>
        </div>

        <div id="slideFeatures"
            class="slide flex-none w-full bg-cover bg-center flex items-center h-[600px] text-white py-24 px-10 relative"
            style="background-image: url(./assets/images/vaccination-features.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <div class="content-wrapper md:w-1/2 z-30">
                <p class="slide-title font-bold text-sm uppercase">Features</p>
                <p class="slide-heading text-3xl font-bold">Effortless Scheduling and Record Management</p>
                <p class="slide-subheading text-sm mb-10 leading-none">
                    Access vaccination records, set reminders, and manage appointments—all from one platform.
                </p>
            </div>
        </div>

        <div id="slideAccessibility"
            class="slide flex-none w-full bg-cover bg-center flex items-center h-[600px] text-white py-24 px-10 relative"
            style="background-image: url(./assets/images/vaccination-accessibility.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <div class="content-wrapper md:w-1/2 z-30">
                <p class="slide-title font-bold text-sm uppercase">Accessibility</p>
                <p class="slide-heading text-3xl font-bold">Connecting Parents and Providers</p>
                <p class="slide-subheading text-sm mb-10 leading-none">
                    A platform designed for seamless interaction between stakeholders, ensuring no vaccination is
                    missed.
                </p>
            </div>
        </div>
    </div>

    <div class="slider-actions absolute top-8 right-16 flex items-center justify-center gap-4">
        <button id="prevButton"
            class=" bg-[#66347F] transition-bg duration-300 focus:bg-[#66347F] text-white rounded-full flex items-center justify-center shadow-md hover:bg-[#D4ADFC]">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M11.8284 12.0005L14.6569 14.8289L13.2426 16.2431L9 12.0005L13.2426 7.75781L14.6569 9.17203L11.8284 12.0005Z">
                </path>
            </svg>
        </button>
        <button id="nextButton"
            class=" bg-[#66347F] transition-bg duration-300 focus:bg-[#66347F] text-white rounded-full flex items-center justify-center shadow-md hover:bg-[#D4ADFC]">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12.1717 12.0005L9.34326 9.17203L10.7575 7.75781L15.0001 12.0005L10.7575 16.2431L9.34326 14.8289L12.1717 12.0005Z">
                </path>
            </svg>
        </button>
    </div>
    <div
        class="indicator-wrapper absolute w-full max-w-xl bottom-4 left-1/2 transform -translate-x-1/2 flex items-center justify-center space-x-2 py-2">
        <div data-slide="0"
            class="indicator-dot size-3 rounded-full bg-[#D4ADFC] hover:bg-[#9E4784] transition-all duration-300 cursor-pointer">
        </div>
        <div data-slide="1"
            class="indicator-dot size-3 rounded-full bg-[#D4ADFC] hover:bg-[#9E4784] transition-all duration-300 cursor-pointer">
        </div>
        <div data-slide="2"
            class="indicator-dot size-3 rounded-full bg-[#D4ADFC] hover:bg-[#9E4784] transition-all duration-300 cursor-pointer">
        </div>
    </div>
</section>
<section class="bg-blue-50 py-16 px-6">
    <div class="w-full max-w-[1500px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="text-center lg:text-left">
            <h2 class="text-3xl font-semibold text-gray-900 mb-4">Register Now for Convenient Vaccination Management
            </h2>
            <p class="text-lg text-gray-700 mb-6">Join our platform and easily manage your child's vaccination
                schedule, track progress, and ensure timely immunizations—all in one place. Stay on top of
                vaccination dates and locations, and never miss an appointment again.</p>
            <p class="text-sm text-gray-500 mb-8">Our system is designed for parents, healthcare providers, and
                administrators to keep track of all vaccination activities. With simple registration, you can access
                all features, including scheduling, reminders, and a detailed vaccination record history.</p>

            <?php 
             if (!isset($_SESSION['parent_id'])) {
            ?>
            <div class="mt-8">
                <a href="./route/register.php"
                    class="text-md text-[#F5EFFF] bg-[#66347F] border-2 border-[#CB9DF0] px-8 py-3 rounded-md transition duration-200 hover:shadow-sm hover:border-[#CDC1FF] hover:text-white">
                    Register
                </a>
            </div>
            <?php
             }
            ?>

        </div>
        <div class="relative">
            <img src="./assets/images/children-clinic.jpg" alt="Register Now Image"
                class="w-full h-full object-cover rounded-lg shadow-lg">
        </div>
    </div>
</section>
<section id="overview" class="bg-gray-100 py-16">
    <div class="w-full max-w-[1600px] mx-auto flex flex-col  px-6 md:px-12">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <h3 class="text-2xl font-semibold text-gray-800">
                    Key Features of Our System
                </h3>
                <p class="text-gray-600">
                    Our platform provides an intuitive and easy-to-use interface for parents, healthcare providers, and
                    administrators, simplifying the vaccination process.
                </p>
                <ul class="list-disc pl-5 space-y-3 text-gray-600">
                    <li>Easy registration and scheduling of vaccination appointments.</li>
                    <li>Secure and digital storage of vaccination records.</li>
                    <li>Automated reminders for upcoming vaccinations and appointments.</li>
                    <li>Role-based access for parents, healthcare providers, and admins.</li>
                    <li>Real-time vaccination status tracking and management.</li>
                </ul>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg">
                    <div
                        class="flex items-center justify-center h-16 w-16 bg-blue-100 text-blue-500 rounded-full mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M7 3V1H9V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V9H20V5H17V7H15V5H9V7H7V5H4V19H10V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7ZM17 12C14.7909 12 13 13.7909 13 16C13 18.2091 14.7909 20 17 20C19.2091 20 21 18.2091 21 16C21 13.7909 19.2091 12 17 12ZM11 16C11 12.6863 13.6863 10 17 10C20.3137 10 23 12.6863 23 16C23 19.3137 20.3137 22 17 22C13.6863 22 11 19.3137 11 16ZM16 13V16.4142L18.2929 18.7071L19.7071 17.2929L18 15.5858V13H16Z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 text-center">Efficient Scheduling</h3>
                    <p class="text-gray-600 text-center mt-3">
                        Easily book and manage vaccination appointments with automated reminders to keep you on track.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg">
                    <div
                        class="flex items-center justify-center h-16 w-16 bg-green-100 text-green-500 rounded-full mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M5 12.5C5 12.8134 5.46101 13.3584 6.53047 13.8931C7.91405 14.5849 9.87677 15 12 15C14.1232 15 16.0859 14.5849 17.4695 13.8931C18.539 13.3584 19 12.8134 19 12.5V10.3287C17.35 11.3482 14.8273 12 12 12C9.17273 12 6.64996 11.3482 5 10.3287V12.5ZM19 15.3287C17.35 16.3482 14.8273 17 12 17C9.17273 17 6.64996 16.3482 5 15.3287V17.5C5 17.8134 5.46101 18.3584 6.53047 18.8931C7.91405 19.5849 9.87677 20 12 20C14.1232 20 16.0859 19.5849 17.4695 18.8931C18.539 18.3584 19 17.8134 19 17.5V15.3287ZM3 17.5V7.5C3 5.01472 7.02944 3 12 3C16.9706 3 21 5.01472 21 7.5V17.5C21 19.9853 16.9706 22 12 22C7.02944 22 3 19.9853 3 17.5ZM12 10C14.1232 10 16.0859 9.58492 17.4695 8.89313C18.539 8.3584 19 7.81342 19 7.5C19 7.18658 18.539 6.6416 17.4695 6.10687C16.0859 5.41508 14.1232 5 12 5C9.87677 5 7.91405 5.41508 6.53047 6.10687C5.46101 6.6416 5 7.18658 5 7.5C5 7.81342 5.46101 8.3584 6.53047 8.89313C7.91405 9.58492 9.87677 10 12 10Z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 text-center">Secure Records</h3>
                    <p class="text-gray-600 text-center mt-3">
                        Keep track of vaccination records with secure and easily accessible digital storage.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg">
                    <div
                        class="flex items-center justify-center h-16 w-16 bg-yellow-100 text-yellow-500 rounded-full mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M5 18H19V11.0314C19 7.14806 15.866 4 12 4C8.13401 4 5 7.14806 5 11.0314V18ZM12 2C16.9706 2 21 6.04348 21 11.0314V20H3V11.0314C3 6.04348 7.02944 2 12 2ZM9.5 21H14.5C14.5 22.3807 13.3807 23.5 12 23.5C10.6193 23.5 9.5 22.3807 9.5 21Z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 text-center">Reminders & Notifications</h3>
                    <p class="text-gray-600 text-center mt-3">
                        Stay on top of vaccination schedules with automated reminders for upcoming doses and
                        appointments.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    require_once('./includes/footer.php');
?>

<script>
$(document).ready(function() {
    const contentSlider = $('#contentSlider');
    const slides = $('.slide');
    const indicatorDots = $('.indicator-dot');
    const slideCount = slides.length;
    let currentSlideIndex = 0;

    function updateSlider() {
        const offset = -currentSlideIndex * 100;
        contentSlider.css('transform', `translateX(${offset}%)`);
        indicatorDots.removeClass('bg-[#D4ADFC]').addClass('bg-[#66347F]');
        indicatorDots.eq(currentSlideIndex).removeClass('bg-[#66347F]').addClass('bg-[#D4ADFC]');
    }

    $('#nextButton').on('click', function() {
        currentSlideIndex = (currentSlideIndex + 1) % slideCount;
        updateSlider();
    });

    $('#prevButton').on('click', function() {
        currentSlideIndex = (currentSlideIndex - 1 + slideCount) % slideCount;
        updateSlider();
    });

    indicatorDots.on('click', function() {
        currentSlideIndex = $(this).data('slide');
        updateSlider();
    });

    updateSlider();
});


document.getElementById("mobile-menu-button").addEventListener("click", () => {
    const menu = document.getElementById("mobile-menu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
});
</script>


</body>

</html>
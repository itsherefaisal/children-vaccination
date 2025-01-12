<?php 

$PATH = '';

if (ROUTE === "index") {
    $PATH = '.';
} else {
    $PATH = '..';
}

?>

<footer class="bg-[#DDE6ED]">
    <div class="mx-auto w-full max-w-[1700px] space-y-8 px-4 py-16 sm:px-6 lg:space-y-16 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div>
                <div class="text-[#66347F] flex items-center gap-2">
                    <img src="<?= $PATH ?>/assets/images/logo.png" class="h-8" alt="Logo"><a href="./index.html">Children
                        vaccination</a>
                </div>

                <p class="mt-4 max-w-xs text-gray-500">
                    Vaccination management for parents, healthcare providers,
                    and administrators
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-4">
                <div>
                    <p class="font-medium text-gray-900">Services</p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Vaccination Scheduling
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Record Management </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Health Reports </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Appointment Reminders
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> User Support </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-medium text-gray-900">Company</p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> About Us </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Our Mission </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Meet the Team </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Careers </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-medium text-gray-900">Quick Links</p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a href="#register-child" class="text-gray-700 transition hover:opacity-75"> Register
                                Now </a>
                        </li>

                        <li>
                            <a href="#find-hospitals" class="text-gray-700 transition hover:opacity-75"> Find
                                Hospitals </a>
                        </li>

                        <li>
                            <a href="#view-vaccines" class="text-gray-700 transition hover:opacity-75"> View
                                Vaccines </a>
                        </li>

                        <li>
                            <a href="#vaccination-schedule" class="text-gray-700 transition hover:opacity-75">
                                Vaccination Schedule </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-medium text-gray-900">Legal</p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Privacy Policy </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Terms & Conditions </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Accessibility </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-700 transition hover:opacity-75"> Data Security </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>

        <p class="text-xs text-gray-500">&copy; 2025. Children Vaccination. All rights reserved.</p>
    </div>
</footer>
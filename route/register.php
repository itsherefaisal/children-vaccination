<?php
    define("ROUTE", 'REGISTER');
    require_once('../includes/header.php');
?>

<section class="min-h-[90vh] py-16 rounded-lg flex items-center justify-center w-full"
    style="background-image: url('./assets/images/bg-minimalist-background-blur.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="max-w-2xl w-[700px] bg-white pt-14 pb-4 rounded-lg">
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
</body>

</html>
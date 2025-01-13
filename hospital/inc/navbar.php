<?php 

$PATH = '';

if (ROUTE === "index") {
    $PATH = '..';
} else {
    $PATH = '../..';
}

?>

<nav class="bg-[#DDE6ED] text-white px-10 py-4 flex justify-between items-center">
    <a href="<?= ROUTE === 'index' ? '.' : '..' ?>/index.php"
        class="text-xl px-4 pt-1 rounded-md font-bold flex gap-2 items-end justify-center">
        <img src="<?= $PATH ?>/assets/images/logo.png" alt="Logo" class="fluid-responsive size-16">
        <span class="text-md text-bold text-[#66347F] pb-2">Children Vaccination</span>
    </a>
    <div class="relative flex items-center">

        <div>
            <input type="text" id="Search" placeholder="Search for vaccines or appointments"
                class="w-[250px] rounded-md border-gray-200 py-2 p-3 text-black shadow-sm sm:text-sm" />
        </div>
        <div class="noti relative">
            <div class="relative">
                <button id="noti-toggle-btn" class="group relative mx-4 bg-zinc-50 p-2 rounded-xl hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-purple-500" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M18 10C18 6.68629 15.3137 4 12 4C8.68629 4 6 6.68629 6 10V18H18V10ZM20 18.6667L20.4 19.2C20.5657 19.4209 20.5209 19.7343 20.3 19.9C20.2135 19.9649 20.1082 20 20 20H4C3.72386 20 3.5 19.7761 3.5 19.5C3.5 19.3918 3.53509 19.2865 3.6 19.2L4 18.6667V10C4 5.58172 7.58172 2 12 2C16.4183 2 20 5.58172 20 10V18.6667ZM9.5 21H14.5C14.5 22.3807 13.3807 23.5 12 23.5C10.6193 23.5 9.5 22.3807 9.5 21Z">
                        </path>
                    </svg>
                    <span
                        class="hidden absolute top-[120%] right-0 text-xs py-1 px-2 bg-black rounded-md text-white group-hover:block">
                        Notifications
                    </span>
                </button>
                <div id="noti-container"
                    class="hidden absolute overflow-hidden right-0 rounded-xl top-[120%] bg-purple-700 w-[330px]">
                    <ul class="py-3 px-2">
                        <li class="border-b border-gray-300 py-1">
                            <h3>lorem15</h3>
                            <p class="text-end">2/3/2024</p>
                        </li>
                    </ul>
                    <a href="<?= ROUTE === 'index' ? './route' : '.' ?>/notifications.php"
                        class="bg-blue-600 block text-center w-full py-2">
                        View All Notifications
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
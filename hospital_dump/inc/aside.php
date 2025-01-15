
<?php 

$PATH = '';

if (ROUTE === "index") {
    $PATH = '.';
} else {
    $PATH = '..';
}

?>

<aside class="container-aside w-28 h-full flex items-center justify-center">
    <div class="aside-nav bg-gray-300 border-2 border-[#DDE6ED] pt-5 pb-4 px-2 rounded-xl">
        <ul class="flex flex-col gap-2">
            <li onclick="window.location.href = '<?= $PATH ?>/index.php'"
                class="group relative flex items-center justify-center p-3 rounded-full cursor-pointer select-none bg-[#DDE6ED] transition-bg duration-200 hover:bg-[#EBD3F8] <?= ROUTE === 'index' ? 'active' : '' ?>">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-[#AD49E1]"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M19 21H5C4.44772 21 4 20.5523 4 20V11L1 11L11.3273 1.6115C11.7087 1.26475 12.2913 1.26475 12.6727 1.6115L23 11L20 11V20C20 20.5523 19.5523 21 19 21ZM13 19H18V9.15745L12 3.7029L6 9.15745V19H11V13H13V19Z">
                        </path>
                    </svg></div>
                <div
                    class="title absolute truncate left-[120%] hidden text-xs py-1 px-2 bg-black rounded-md text-white group-hover:block">
                    Dashboard
                </div>
            </li>
            <li onclick="window.location.href = '<?= $PATH === '.' ? './route' : '.' ?>/vaccines.php'"
                class="group relative flex items-center justify-center p-3 rounded-full cursor-pointer select-none bg-[#DDE6ED] transition-bg duration-200 hover:bg-[#EBD3F8] <?= ROUTE === 'vaccines' ? 'active' : '' ?>">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-[#AD49E1]"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M21.6779 7.97918L20.2637 9.39339L18.1424 7.27207L16.021 9.39339L19.5566 12.9289L18.1424 14.3431L17.4353 13.636L11.0713 20H5.41444L3.29312 22.1213L1.87891 20.7071L4.00023 18.5858V12.9289L10.3642 6.56497L9.65708 5.85786L11.0713 4.44365L14.6068 7.97918L16.7281 5.85786L14.6068 3.73654L16.021 2.32233L21.6779 7.97918ZM16.021 12.2218L11.7784 7.97918L10.3642 9.39339L12.4855 11.5147L11.0713 12.9289L8.94997 10.8076L7.53576 12.2218L9.65708 14.3431L8.24287 15.7574L6.12155 13.636L6.00023 13.7574V18H10.2429L16.021 12.2218Z">
                        </path>
                    </svg></div>
                <div
                    class="title absolute truncate left-[120%] hidden text-xs py-1 px-2 bg-black rounded-md text-white  group-hover:block">
                    Manage Vaccines
                </div>
            </li>
            <li onclick="window.location.href = '<?= $PATH === '.' ? './route' : '.' ?>/appointments.php'"
                class="group relative flex items-center justify-center p-3 rounded-full cursor-pointer select-none bg-[#DDE6ED] transition-bg duration-200 hover:bg-[#EBD3F8] <?= ROUTE === 'appointments' ? 'active' : '' ?>">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-[#AD49E1]"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M7 3V1H9V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V9H20V5H17V7H15V5H9V7H7V5H4V19H10V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7ZM17 12C14.7909 12 13 13.7909 13 16C13 18.2091 14.7909 20 17 20C19.2091 20 21 18.2091 21 16C21 13.7909 19.2091 12 17 12ZM11 16C11 12.6863 13.6863 10 17 10C20.3137 10 23 12.6863 23 16C23 19.3137 20.3137 22 17 22C13.6863 22 11 19.3137 11 16ZM16 13V16.4142L18.2929 18.7071L19.7071 17.2929L18 15.5858V13H16Z">
                        </path>
                    </svg></div>
                <div
                    class="title absolute truncate left-[120%] hidden text-xs py-1 px-2 bg-black rounded-md text-white  group-hover:block">
                    Manage Appointments
                </div>
            </li>
            <li onclick="window.location.href = '<?= $PATH === '.' ? './route' : '.' ?>/settings.php'"
                class="group relative flex items-center justify-center p-3 rounded-full cursor-pointer select-none bg-[#DDE6ED] transition-bg duration-200 hover:bg-[#EBD3F8] <?= ROUTE === 'settings' ? 'active' : '' ?>">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-[#AD49E1]"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M8.68637 4.00008L11.293 1.39348C11.6835 1.00295 12.3167 1.00295 12.7072 1.39348L15.3138 4.00008H19.0001C19.5524 4.00008 20.0001 4.4478 20.0001 5.00008V8.68637L22.6067 11.293C22.9972 11.6835 22.9972 12.3167 22.6067 12.7072L20.0001 15.3138V19.0001C20.0001 19.5524 19.5524 20.0001 19.0001 20.0001H15.3138L12.7072 22.6067C12.3167 22.9972 11.6835 22.9972 11.293 22.6067L8.68637 20.0001H5.00008C4.4478 20.0001 4.00008 19.5524 4.00008 19.0001V15.3138L1.39348 12.7072C1.00295 12.3167 1.00295 11.6835 1.39348 11.293L4.00008 8.68637V5.00008C4.00008 4.4478 4.4478 4.00008 5.00008 4.00008H8.68637ZM6.00008 6.00008V9.5148L3.5148 12.0001L6.00008 14.4854V18.0001H9.5148L12.0001 20.4854L14.4854 18.0001H18.0001V14.4854L20.4854 12.0001L18.0001 9.5148V6.00008H14.4854L12.0001 3.5148L9.5148 6.00008H6.00008ZM12.0001 16.0001C9.79094 16.0001 8.00008 14.2092 8.00008 12.0001C8.00008 9.79094 9.79094 8.00008 12.0001 8.00008C14.2092 8.00008 16.0001 9.79094 16.0001 12.0001C16.0001 14.2092 14.2092 16.0001 12.0001 16.0001ZM12.0001 14.0001C13.1047 14.0001 14.0001 13.1047 14.0001 12.0001C14.0001 10.8955 13.1047 10.0001 12.0001 10.0001C10.8955 10.0001 10.0001 10.8955 10.0001 12.0001C10.0001 13.1047 10.8955 14.0001 12.0001 14.0001Z">
                        </path>
                    </svg></div>
                <div
                    class="title absolute left-[120%] hidden text-xs py-1 px-2 bg-black rounded-md text-white  group-hover:block">
                    Settings
                </div>
            </li>
            <li onclick="window.location.href = '<?= $PATH === '.' ? './route' : '.' ?>/logout.php'"
                class="mt-6 group relative flex items-center justify-center p-3 rounded-full cursor-pointer select-none bg-red-500 transition-bg duration-200 hover:bg-red-400">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-gray-200"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M4 18H6V20H18V4H6V6H4V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V18ZM6 11H13V13H6V16L1 12L6 8V11Z">
                        </path>
                    </svg></div>
                <div
                    class="title absolute truncate left-[120%] hidden text-xs py-1 px-2 bg-black rounded-md text-white  group-hover:block">
                    Logout
                </div>
            </li>
        </ul>
    </div>
</aside>
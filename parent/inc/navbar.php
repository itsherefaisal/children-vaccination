<?php 

$PATH = '';

if (ROUTE === "index") {
    $PATH = '..';
} else {
    $PATH = '../..';
}

?>

<style>
.search-overlay {
    overflow: hidden;
}

#searchBox {
    width: 90%;
    max-width: 500px;
    border-radius: 0.5rem;
    transform: translateY(50%);
    opacity: 0;
    transition: transform 100ms ease-out, opacity 300ms ease-out;
}

#searchBox.show {
    transform: translateY(0);
    opacity: 1;
}

@media (max-width: 500px) {
    #searchBox {
        width: 100%;
        height: 100vh;
        margin: 0;
        border-radius: 0;
    }
}
</style>
<script defer>
$(document).ready(function() {
    const searchBtn = document.getElementById('searchBtn');
    const searchContainer = document.getElementById('searchContainer');
    const searchBox = document.getElementById('searchBox');
    const searchContainerCloseBtn = document.getElementById('closeBtn');
    const body = document.body;

    const toggleSearchContainer = (isVisible) => {
        const method = isVisible ? 'remove' : 'add';
        searchContainer.classList[method]('hidden');
        body.classList[isVisible ? 'add' : 'remove']('search-overlay');

        if (isVisible) {
            setTimeout(() => {
                searchBox.classList.add('show');
            }, 10);
        } else {
            searchBox.classList.remove('show');
        }
    };

    searchBtn.addEventListener('click', () => toggleSearchContainer(true));
    searchContainerCloseBtn.addEventListener('click', () => toggleSearchContainer(false));
    document.addEventListener('click', (event) => {
        if (!searchContainer.classList.contains('hidden') && !searchBox.contains(event.target) && !
            searchBtn.contains(event.target)) {
            toggleSearchContainer(false);
        }
    });

    function debounce(func, delay) {
        let debounceTimer;
        return function(...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function searchContent(query) {
    if (query.trim() === "") {
        $(".search_result_container").empty().hide();
        return;
    }

    $.ajax({
        url: "<?= (ROUTE === 'index') ? './controller/search.controller.php' : '../controller/search.controller.php' ?>",
        type: "GET",
        data: {
            query: query
        },
        success: function(response) {
            const results = JSON.parse(response);
            $(".search_result_container").empty().show();

            if (results.length > 0) {
                results.forEach(result => {
                    let resultHTML = `
                        <a href="${result.category === 'Hospital' ? '<?= (ROUTE === 'index') ? './route/' : './' ?>view_hospital.php?hospital_id=' + result.id : '<?= (ROUTE === 'index') ? './route/' : './' ?>view_vaccine.php?vaccine_id=' + result.id}" 
                           class="search_result_body mx-1 py-1 px-2 overflow-hidden w-full hover:bg-gray-100 transition duration-300 rounded-lg">
                            <div class="search_result_heading flex flex-col">
                                <div class="search_result_subhead flex items-center justify-between">
                                    <p class="text-[8px] text-gray-500">NAME</p>
                                    <p class="text-xs font-bold text-[#563A9C]">${result.category}</p>
                                </div>
                                <h3 class="text-black text-sm pl-1 truncate">${result.title}</h3>
                            </div>
                            <div class="search_result_subheading flex flex-nowrap w-full items-end gap-1 mt-1 text-xs">
                                ${result.category === 'Hospital' ? `
                                    <div class="flex flex-col">
                                        <span class="text-[10px] pl-2">Country</span>
                                        <span class="py-1 px-2 bg-[#563A9C] text-xs text-white rounded-xl truncate">${result.country}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] pl-2">City</span>
                                        <span class="py-1 px-2 bg-[#563A9C] text-xs text-white rounded-xl truncate">${result.city}</span>
                                    </div>` : ''}
                            </div>
                        </a>
                    `;
                    $(".search_result_container").append(resultHTML);
                });
            } else {
                $(".search_result_container").append(
                    `<div class="text-red-500 p-2 text-sm text-center">No results found</div>`
                );
            }
        },
        error: function() {
            $(".search_result_container")
                .empty()
                .append(
                    `<div class="text-red-500 p-2 text-sm text-center">Error fetching results</div>`
                )
                .show();
        },
    });
}




    $("#searchInput").on(
        "input",
        debounce(function() {
            const query = $(this).val();
            searchContent(query);
        }, 300)
    );
});
</script>

<nav class="bg-[#DDE6ED] text-white px-10 py-4 flex justify-between items-center">
    <a href="<?= ROUTE === 'index' ? '.' : '..' ?>/index.php"
        class="text-xl px-4 pt-1 rounded-md font-bold flex gap-2 items-end justify-center">
        <img src="<?= $PATH ?>/assets/images/logo.png" alt="Logo" class="fluid-responsive size-16">
        <span class="text-md text-bold text-[#66347F] pb-2">Children Vaccination</span>
    </a>
    <div class="relative flex items-center">

        <div class="parent-name text-purple-800 mr-4">
            Welcome, <?= $PARENT_FIRST ?? 'UNKNOW'?>
        </div>
        <button id="searchBtn"
            class="flex items-center justify-between bg-white text-black border border-gray-300 w-[250px] transition duration-200 hover:bg-gray-200 text-white py-2 px-3 rounded-lg">
            <span class="truncate text-sm text-black">
                Search for Vaccines, Hospitals
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 stroke-2 text-black" viewBox="0 0 24 24"
                fill="currentColor">
                <path
                    d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z">
                </path>
            </svg>
        </button>
        <div id="searchContainer"
            class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div id="searchBox" class="bg-white rounded-lg pb-6 shadow-lg overflow-hidden text-black h-[400px]">
                <label for="searchInput" class="relative flex justify-between items-center mb-2 pl-6 pr-20 px-2 group">
                    <input type="text" id="searchInput" name="searchInput" placeholder="Type here to Search..."
                        class="placeholder:text-gray-400 pt-5 pb-4 pl-4 w-full border-b border-gray-300 transition-focus duration-300 focus:border-gray-200 bg-transparent outline-none"
                        autocomplete="off" />
                    <button id="closeBtn"
                        class="absolute right-5 top-4 my-auto p-1 border-2 border-transparent rounded-full transition duration-200 text-gray-400 hover:border-red-500 hover:text-white hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </label>
                <div
                    class="search_result_container w-full py-4 px-6 overflow-x-hidden flex flex-col gap-2 overflow-y-auto flex-grow max-h-[calc(100%-43px)]">


                </div>
            </div>
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
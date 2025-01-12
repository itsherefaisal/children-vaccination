<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Cares Vaccination</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <script src="../frameworks/jquery/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    .container-main {
        height: calc(100vh - 100px);
    }

    li.active {
        background: #EBD3F8;
    }
    </style>
</head>

<body class="bg-gray-100 overflow-hidden">
    <?php
        define("ROUTE", 'index');
        require_once('./inc/navbar.php');
    ?>

    <main class="container-main w-full  flex items-center">
        <?php
            require_once('./inc/aside.php');
        ?>
        <section class="w-full max-w-[1700px] mx-auto h-full bg-white p-6 overflow-x-hidden overflow-y-auto">
            <div class="covid-chart px-8 pb-8 pt-4 bg-zinc-200 rounded-xl">
                <h3 class="text-center py-2">Covid 19 Overall Cases</h3>
                <canvas id="covidChart" class="w-full" height="250px"></canvas>
            </div>
            <div class="status-appointments p-4">
                <h2 class="text-xl font-bold my-4 pl-4">Appointments</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 overflow-x-auto gap-4">
                    <!-- Approved -->
                    <div class="bg-green-100 text-green-800 rounded-xl p-4 flex flex-col items-center justify-center">
                        <h2 class="text-3xl font-bold">48</h2>
                        <p class="text-lg">Approved</p>
                    </div>
                    <!-- Rejected -->
                    <div class="bg-red-100 text-red-800 rounded-xl p-4 flex flex-col items-center justify-center">
                        <h2 class="text-3xl font-bold">12</h2>
                        <p class="text-lg">Rejected</p>
                    </div>
                    <!-- Pending -->
                    <div class="bg-yellow-100 text-yellow-800 rounded-xl p-4 flex flex-col items-center justify-center">
                        <h2 class="text-3xl font-bold">15</h2>
                        <p class="text-lg">Pending</p>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <script src="../frameworks/chartjs/chart.js"></script>
    <script defer>
    // Fetch COVID-19 data
    async function fetchCovidData() {
        const response = await fetch('https://disease.sh/v3/covid-19/historical/all?lastdays=all');
        const data = await response.json();

        // Process data for yearly statistics
        const years = {};
        Object.keys(data.cases).forEach(date => {
            const year = new Date(date).getFullYear();
            if (!years[year]) years[year] = {
                cases: 0,
                deaths: 0,
                recovered: 0
            };

            years[year].cases += data.cases[date];
            years[year].deaths += data.deaths[date];
            years[year].recovered += data.recovered[date];
        });

        return years;
    }

    // Render Chart.js chart
    async function renderCovidChart() {
        const covidData = await fetchCovidData();
        const years = Object.keys(covidData);
        const cases = years.map(year => covidData[year].cases);
        const deaths = years.map(year => covidData[year].deaths);
        const recovered = years.map(year => covidData[year].recovered);

        const ctx = document.getElementById('covidChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                        label: 'Cases',
                        data: cases,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                    {
                        label: 'Deaths',
                        data: deaths,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                    {
                        label: 'Recovered',
                        data: recovered,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Counts'
                        },
                        beginAtZero: true
                    },
                },
            },
        });
    }

    renderCovidChart();
    
    const toggleBtn = document.getElementById('noti-toggle-btn');
    const notiContainer = document.getElementById('noti-container');

    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notiContainer.classList.toggle('hidden');
    });

    document.addEventListener('click', () => {
        if (!notiContainer.classList.contains('hidden')) {
            notiContainer.classList.add('hidden');
        }
    });

    notiContainer.addEventListener('click', (e) => {
        e.stopPropagation();
    });
    </script>
</body>

</html>
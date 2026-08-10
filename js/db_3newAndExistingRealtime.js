$(document).ready(function () {
    let regionDeliveredChart = null;

    function initRegionDeliveredChart() {
        const ctx = document.getElementById('regionDeliveredChart');
        if (!ctx) return;

        regionDeliveredChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['MM', 'Luzon', 'Visayas', 'Mindanao'],
                datasets: [{
                    data: [0, 0, 0, 0],
                    backgroundColor: [
                        '#0d6efd', // MM
                        '#198754', // Luzon
                        '#ffc107', // Visayas
                        '#dc3545'  // Mindanao
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }

    function fetchRegionDeliveredData(selectedMonth = null) {
        if (!selectedMonth) {
            const monthFilterEl = document.getElementById('kpiMonthFilter');
            selectedMonth = monthFilterEl ? monthFilterEl.value : 'current';
        }

        const selectedSbu = window.currentSbuFilter || 'all';

        let requestData = { month: selectedMonth, sbu: selectedSbu };
        if (selectedMonth === 'custom') {
            const dateFromEl = document.getElementById('dateFrom');
            const dateToEl = document.getElementById('dateTo');
            requestData.dateFrom = dateFromEl ? dateFromEl.value : '';
            requestData.dateTo = dateToEl ? dateToEl.value : '';
        }

        $.ajax({
            url: '../php/get_3AccountStatusTotal.php',
            type: 'GET',
            data: requestData,
            dataType: 'json',
            success: function (response) {
                if (response && response.success) {
                    updateRegionDeliveredLayout(response);
                }
            },
            error: function (xhr, status, error) {
                console.error("[Region Delivered] Fetch Error:", error);
            }
        });
    }

    function updateRegionDeliveredLayout(data) {
        if (!regionDeliveredChart) return;

        const mm = parseInt(data.mm) || 0;
        const luzon = parseInt(data.luzon) || 0;
        const visayas = parseInt(data.visayas) || 0;
        const mindanao = parseInt(data.mindanao) || 0;
        const total = parseInt(data.total) || 0;

        regionDeliveredChart.data.datasets[0].data = [mm, luzon, visayas, mindanao];
        regionDeliveredChart.update();

        // Update counts
        const elTotal = document.getElementById('donutTotalCount');
        const elMM = document.getElementById('mmCount');
        const elLuzon = document.getElementById('luzonCount');
        const elVisayas = document.getElementById('visayasCount');
        const elMindanao = document.getElementById('mindanaoCount');

        if (elTotal) elTotal.innerText = total;
        if (elMM) elMM.innerText = mm;
        if (elLuzon) elLuzon.innerText = luzon;
        if (elVisayas) elVisayas.innerText = visayas;
        if (elMindanao) elMindanao.innerText = mindanao;

        // Update percentages
        const calcPercent = (val, total) => total > 0 ? ((val / total) * 100).toFixed(1) + '%' : '0.0%';
        
        const elMMPercent = document.getElementById('mmPercent');
        const elLuzonPercent = document.getElementById('luzonPercent');
        const elVisayasPercent = document.getElementById('visayasPercent');
        const elMindanaoPercent = document.getElementById('mindanaoPercent');

        if (elMMPercent) elMMPercent.innerText = calcPercent(mm, total);
        if (elLuzonPercent) elLuzonPercent.innerText = calcPercent(luzon, total);
        if (elVisayasPercent) elVisayasPercent.innerText = calcPercent(visayas, total);
        if (elMindanaoPercent) elMindanaoPercent.innerText = calcPercent(mindanao, total);
    }

    initRegionDeliveredChart();
    fetchRegionDeliveredData();

    document.addEventListener('kpiFilterUpdated', function (e) {
        fetchRegionDeliveredData(e.detail.period);
    });

    document.addEventListener('kpiSbuFilterUpdated', function (e) {
        fetchRegionDeliveredData();
    });

    window.refreshRegionDelivered = fetchRegionDeliveredData;
});
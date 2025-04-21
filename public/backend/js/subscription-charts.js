// Chart.js initialization and configuration
let mainChart = null;
let growthChart = null;
let churnChart = null;
let arpuChart = null;
let subscriptionTypeChart = null;
let trialSubscriptionChart = null;


document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM loaded, initializing charts');
    initializeCharts();

    // Set up Livewire event listeners
    if (typeof Livewire !== 'undefined') {
        console.log('Livewire detected, setting up listeners');

        // Listen for Livewire events
        Livewire.on('chartDataUpdated', (data) => {
            console.log('Livewire chartDataUpdated received:', data);
            updateAllCharts(data);
        });

        // Add a manual refresh trigger
        document.querySelectorAll('[wire\\:click="$refresh"]').forEach(btn => {
            btn.addEventListener('click', () => {
                console.log('Manual refresh triggered');
                setTimeout(() => {
                    if (Livewire.components) {
                        const component = Object.values(Livewire.components.componentsById)[0];
                        if (component) {
                            component.call('refreshChartData');
                        }
                    }
                }, 300);
            });
        });
    }

    // Fallback direct event listener
    window.addEventListener('chartDataUpdated', event => {
        console.log('Window chartDataUpdated event received:', event.detail);
        updateAllCharts(event.detail);
    });

    // Handle date range selection
    setupDateRangeHandlers();

    // Initialize with dummy data if no events arrive within 2 seconds
    setTimeout(() => {
        if (!mainChart || mainChart.data.datasets.length === 0) {
            console.log('No chart data received, initializing with dummy data');
            initializeWithDummyData();
        }
    }, 2000);
});

function setupDateRangeHandlers() {
    // Handle date range dropdown clicks
    document.querySelectorAll('[wire\\:click^="updateDateRange"]').forEach(btn => {
        btn.addEventListener('click', function () {
            console.log('Date range update clicked:', this.innerText.trim());
            // Add loading indicator
            document.querySelectorAll('.chart-area, .chart-pie').forEach(chart => {
                chart.classList.add('loading');
            });
        });
    });

    // Handle date inputs
    const startDateInput = document.querySelector('input[wire\\:model="startDate"]');
    const endDateInput = document.querySelector('input[wire\\:model="endDate"]');

    if (startDateInput && endDateInput) {
        [startDateInput, endDateInput].forEach(input => {
            input.addEventListener('change', function () {
                console.log('Date input changed:', this.value);
            });
        });
    }
}

function initializeCharts() {
    // Get chart contexts - add null checks to avoid errors
    const mainChartCtx = document.getElementById('mainChart')?.getContext('2d');
    const growthChartCtx = document.getElementById('growthChart')?.getContext('2d');
    const churnChartCtx = document.getElementById('churnChart')?.getContext('2d');
    const arpuChartCtx = document.getElementById('arpuChart')?.getContext('2d');
    const subscriptionTypeChartCtx = document.getElementById('subscriptionTypeChart')?.getContext('2d');

    // Enhanced color palette with transparency
    const colorPalette = {
        revenue: '#4e73df',
        monthlyRevenue: '#36b9cc',
        yearlyRevenue: '#1cc88a',
        lifetimeRevenue: '#f6c23e',
        subscriptions: '#4e73df',
        cancellations: '#e74a3b',
        growth: '#1cc88a',
        churn: '#e74a3b',
        arpu: '#1cc88a',
        monthly: '#4e73df',
        yearly: '#1cc88a',
        lifetime: '#f6c23e',
        background: '#e9ecef'
    };

    // Initialize main chart
    if (mainChartCtx) {
        console.log('Initializing main chart');
        mainChart = new Chart(mainChartCtx, {
            type: 'bar', data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Default empty labels
                datasets: [{
                    label: 'Loading data...', data: [0, 0, 0, 0, 0, 0], // Placeholder data
                    backgroundColor: 'rgba(78, 115, 223, 0.2)', borderColor: colorPalette.revenue, borderWidth: 1
                }]
            }, options: {
                responsive: true, maintainAspectRatio: false, animation: {
                    duration: 1000, easing: 'easeOutQuart'
                }, scales: {
                    y: {
                        beginAtZero: true, grid: {
                            drawBorder: false, color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }, x: {
                        grid: {
                            display: false
                        }
                    }
                }, plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    } else {
        console.warn('Main chart canvas not found');
    }

    // Initialize growth chart
    if (growthChartCtx) {
        console.log('Initializing growth chart');
        growthChart = new Chart(growthChartCtx, {


            type: 'doughnut', data: {
                labels: ['Growth', 'Remaining'], datasets: [{
                    data: [70, 30], backgroundColor: [colorPalette.arpu, colorPalette.background], borderWidth: 0
                }]
            }, options: {
                responsive: true, maintainAspectRatio: false, cutout: '80%', plugins: {
                    legend: {
                        display: false
                    }
                }, animation: {
                    animateRotate: true, animateScale: true
                }
            }
        });
    }

    // Initialize churn chart
    if (churnChartCtx) {
        console.log('Initializing churn chart');
        churnChart = new Chart(churnChartCtx, {


            type: 'doughnut', data: {
                labels: ['Churn', 'Remaining'], datasets: [{
                    data: [70, 30], backgroundColor: [colorPalette.arpu, colorPalette.background], borderWidth: 0
                }]
            }, options: {
                responsive: true, maintainAspectRatio: false, cutout: '80%', plugins: {
                    legend: {
                        display: false
                    }
                }, animation: {
                    animateRotate: true, animateScale: true
                }
            }

        });
    }

    // Initialize ARPU chart
    if (arpuChartCtx) {
        console.log('Initializing ARPU chart');
        arpuChart = new Chart(arpuChartCtx, {
            type: 'doughnut', data: {
                labels: ['ARPU', 'Benchmark'], datasets: [{
                    data: [70, 30], backgroundColor: [colorPalette.arpu, colorPalette.background], borderWidth: 0
                }]
            }, options: {
                responsive: true, maintainAspectRatio: false, cutout: '80%', plugins: {
                    legend: {
                        display: false
                    }
                }, animation: {
                    animateRotate: true, animateScale: true
                }
            }
        });
    }

    // Initialize subscription type chart
    if (subscriptionTypeChartCtx) {
        console.log('Initializing subscription type chart');
        subscriptionTypeChart = new Chart(subscriptionTypeChartCtx, {
            type: 'pie', data: {
                labels: ['Monthly', 'Yearly', 'Lifetime'], datasets: [{
                    data: [33, 33, 34], // Default equal distribution
                    backgroundColor: [colorPalette.monthly, colorPalette.yearly, colorPalette.lifetime],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            }, options: {
                responsive: true, maintainAspectRatio: false, plugins: {
                    legend: {
                        position: 'bottom', labels: {
                            padding: 20, usePointStyle: true, pointStyle: 'circle'
                        }
                    }, tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                }, animation: {
                    animateRotate: true, animateScale: true
                }
            }
        });
    }
}


function updateAllCharts(data) {
    console.log('Updating all charts with data:', data);

    // Remove loading indicators
    document.querySelectorAll('.chart-area, .chart-pie').forEach(chart => {
        chart.classList.remove('loading');
    });

    // Guard clause to ensure we have valid data
    if (!data) {
        console.error('No data received for chart update');
        return;
    }

    try {
        // Update all charts with the new data
        if (data.revenueData && Array.isArray(data.revenueData)) {
            updateMainChart(data.revenueData, data.selectedView || 'revenue', data.chartType || 'bar');
        } else {
            console.warn('Invalid revenue data format:', Array.isArray(data.revenueData));
            console.table(data)

        }

        if (data.metrics) {
            updateMetricCharts(data.metrics);

            if (data.metrics.subscription_distribution) {
                updateSubscriptionTypeChart(data.metrics.subscription_distribution);
            }
        }
    } catch (error) {
        console.error('Error updating charts:', error);
    }
}

function updateMainChart(chartData, selectedView, chartType) {
    // Safety check
    if (!mainChart) {
        console.error('Main chart not initialized');
        return;
    }

    // Log All Parameter

    console.table('chartData:', chartData);
    console.table('selectedView:', selectedView);
    console.table('chartType:', chartType);

    try {
        console.log('Updating main chart:', {type: chartType, view: selectedView, dataPoints: chartData.length});

        // Create gradient function
        const createGradient = (color) => {
            if (!mainChart.ctx) return color;
            const ctx = mainChart.ctx;
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, color);
            gradient.addColorStop(1, `${color}80`); // Add 50% transparency
            return gradient;
        };

        // Color palette with solid and gradient options
        const colorPalette = {
            revenue: '#4e73df',
            revenueGradient: createGradient('#4e73df'),
            monthlyRevenue: '#36b9cc',
            monthlyRevenueGradient: createGradient('#36b9cc'),
            yearlyRevenue: '#1cc88a',
            yearlyRevenueGradient: createGradient('#1cc88a'),
            lifetimeRevenue: '#f6c23e',
            lifetimeRevenueGradient: createGradient('#f6c23e'),
            subscriptions: '#4e73df',
            subscriptionsGradient: createGradient('#4e73df'),
            cancellations: '#e74a3b',
            cancellationsGradient: createGradient('#e74a3b')
        };

        // Clear previous chart
        mainChart.data.labels = [];
        mainChart.data.datasets = [];

        // Check if chartData exists and is an array
        if (!chartData || !Array.isArray(chartData) || chartData.length === 0) {
            console.warn('No chart data provided or invalid data format');
            mainChart.data.labels = ['No Data'];
            mainChart.data.datasets = [{
                label: 'No Data Available',
                data: [0],
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: '#4e73df',
                borderWidth: 1
            }];
            mainChart.update();
            return;
        }

        // Set labels from chart data
        mainChart.data.labels = chartData.map(item => item.label);

        // Update chart type
        mainChart.config.type = chartType === 'area' ? 'line' : chartType;

        // Configure based on the selected view and chart type
        if (selectedView === 'revenue') {
            mainChart.data.datasets = [{
                label: 'Total Revenue',
                data: chartData.map(item => item.revenue || 0),
                borderColor: colorPalette.revenue,
                backgroundColor: chartType === 'area' ? colorPalette.revenueGradient : chartType === 'line' ? colorPalette.revenue : colorPalette.revenueGradient,
                fill: chartType === 'area',
                tension: 0.3,
                borderWidth: chartType === 'line' ? 3 : 1
            }, {
                label: 'Monthly Revenue',
                data: chartData.map(item => item.monthly_revenue || 0),
                borderColor: colorPalette.monthlyRevenue,
                backgroundColor: chartType === 'area' ? colorPalette.monthlyRevenueGradient : chartType === 'line' ? colorPalette.monthlyRevenue : colorPalette.monthlyRevenueGradient,
                fill: chartType === 'area',
                tension: 0.3,
                borderWidth: chartType === 'line' ? 3 : 1
            }, {
                label: 'Yearly Revenue',
                data: chartData.map(item => item.yearly_revenue || 0),
                borderColor: colorPalette.yearlyRevenue,
                backgroundColor: chartType === 'area' ? colorPalette.yearlyRevenueGradient : chartType === 'line' ? colorPalette.yearlyRevenue : colorPalette.yearlyRevenueGradient,
                fill: chartType === 'area',
                tension: 0.3,
                borderWidth: chartType === 'line' ? 3 : 1
            }, {
                label: 'Lifetime Revenue',
                data: chartData.map(item => item.lifetime_revenue || 0),
                borderColor: colorPalette.lifetimeRevenue,
                backgroundColor: chartType === 'area' ? colorPalette.lifetimeRevenueGradient : chartType === 'line' ? colorPalette.lifetimeRevenue : colorPalette.lifetimeRevenueGradient,
                fill: chartType === 'area',
                tension: 0.3,
                borderWidth: chartType === 'line' ? 3 : 1
            }];
        } else {
            // Subscription view
            mainChart.data.datasets = [{
                label: 'New Subscriptions',
                data: chartData.map(item => item.subscriptions || 0),
                borderColor: colorPalette.subscriptions,
                backgroundColor: chartType === 'area' ? colorPalette.subscriptionsGradient : chartType === 'line' ? colorPalette.subscriptions : colorPalette.subscriptionsGradient,
                fill: chartType === 'area',
                tension: 0.3,
                borderWidth: chartType === 'line' ? 3 : 1
            }, {
                label: 'Cancellations',
                data: chartData.map(item => item.cancellations || 0),
                borderColor: colorPalette.cancellations,
                backgroundColor: chartType === 'area' ? colorPalette.cancellationsGradient : chartType === 'line' ? colorPalette.cancellations : colorPalette.cancellationsGradient,
                fill: chartType === 'area',
                tension: 0.3,
                borderWidth: chartType === 'line' ? 3 : 1
            }];
        }

        // Update chart options
        mainChart.options = {
            responsive: true, maintainAspectRatio: false, scales: {
                y: {
                    beginAtZero: true, grid: {
                        drawBorder: false, color: 'rgba(0, 0, 0, 0.05)'
                    }, ticks: {
                        callback: function (value) {
                            return selectedView === 'revenue' ? '$' + value : value;
                        }
                    }
                }, x: {
                    grid: {
                        display: false
                    }
                }
            }, plugins: {
                legend: {
                    position: 'top', labels: {
                        padding: 20, usePointStyle: true, pointStyle: 'circle'
                    }
                }, tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (selectedView === 'revenue') {
                                label += '$' + context.parsed.y;
                            } else {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#ffffff',
                    borderWidth: 1
                }
            }, animation: {
                duration: 1000, easing: 'easeOutQuart'
            }
        };

        // Update chart
        mainChart.update();
    } catch (error) {
        console.error('Error updating main chart:', error);
    }
}


function updateMetricCharts(metrics) {
    try {
        console.log('Updating metric charts with:', metrics);

        // Update Growth Chart
        if (growthChart) {
            let growthRate = parseFloat(metrics.growth_rate) || 0;
            growthChart.data.datasets[0].data = [growthRate, Math.max(0, 100 - growthRate)];
            growthChart.update();
        }

        // Update Churn Chart
        if (churnChart) {
            let churnRate = parseFloat(metrics.churn_rate) || 0;
            churnChart.data.datasets[0].data = [churnRate, Math.max(0, 100 - churnRate)];
            churnChart.update();
        }

        // Update ARPU Chart - calculating relative to some benchmark
        if (arpuChart) {
            let arpu = parseFloat(metrics.average_revenue_per_user) || 0;
            let benchmark = 50; // Example benchmark value
            let arpuPercentage = Math.min(100, (arpu / benchmark) * 100);
            arpuChart.data.datasets[0].data = [arpuPercentage, Math.max(0, 100 - arpuPercentage)];
            arpuChart.update();
        }
    } catch (error) {
        console.error('Error updating metric charts:', error);
    }
}

function updateSubscriptionTypeChart(distribution) {
    try {
        if (!subscriptionTypeChart) {
            console.error('Subscription type chart not initialized');
            return;
        }

        console.log('Updating subscription type chart with:', distribution);

        if (distribution) {
            const monthlyPercent = parseFloat(distribution.monthly_percent) || 0;
            const yearlyPercent = parseFloat(distribution.yearly_percent) || 0;
            const lifetimePercent = parseFloat(distribution.lifetime_percent) || 0;

            subscriptionTypeChart.data.datasets[0].data = [monthlyPercent, yearlyPercent, lifetimePercent];

            subscriptionTypeChart.update();
        }
    } catch (error) {
        console.error('Error updating subscription type chart:', error);
    }
}

// update Trial Subscription CHart

function updateTrialSubscriptionChart(distribution) {
    try {
        if (!trialSubscriptionChart) {
            console.error('Subscription type chart not initialized');
            return;
        }

        console.log('Updating subscription type chart with:', distribution);

        if (distribution) {
            const monthlyPercent = parseFloat(distribution.monthly_percent) || 0;
            const yearlyPercent = parseFloat(distribution.yearly_percent) || 0;
            const lifetimePercent = parseFloat(distribution.lifetime_percent) || 0;

            trialSubscriptionChart.data.datasets[0].data = [monthlyPercent, yearlyPercent, lifetimePercent];

            trialSubscriptionChart.update();
        }
    } catch (error) {
        console.error('Error updating subscription type chart:', error);
    }


}

// Add chart helper functions
if (typeof Chart !== 'undefined' && !Chart.helpers.color) {
    Chart.helpers.color = function (color) {
        return {
            alpha: function (opacity) {
                if (color.startsWith('#')) {
                    const r = parseInt(color.slice(1, 3), 16);
                    const g = parseInt(color.slice(3, 5), 16);
                    const b = parseInt(color.slice(5, 7), 16);
                    return `rgba(${r}, ${g}, ${b}, ${opacity})`;
                }
                return color;
            }, rgb: function () {
                if (color.startsWith('#')) {
                    return {
                        r: parseInt(color.slice(1, 3), 16),
                        g: parseInt(color.slice(3, 5), 16),
                        b: parseInt(color.slice(5, 7), 16)
                    };
                }
                return {r: 0, g: 0, b: 0};
            }
        };
    };
}

// Adding CSS for loading indicators
document.addEventListener('DOMContentLoaded', function () {
    const style = document.createElement('style');
    style.textContent = `
        .chart-area.loading, .chart-pie.loading {
            position: relative;
        }
        .chart-area.loading:after, .chart-pie.loading:after {
            content: "Loading...";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
            color: #666;
            background: rgba(255,255,255,0.8);
            padding: 8px 16px;
            border-radius: 4px;
            z-index: 10;
        }
    `;
    document.head.appendChild(style);
});
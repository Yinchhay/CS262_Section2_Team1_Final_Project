document.addEventListener('DOMContentLoaded', (event) => {
    const ctx = document.getElementById('myDoughnutChart').getContext('2d');
    const percentage = 75;  // Set the percentage you want to display

    const data = {
        labels: ['Correct', 'Incorrect'],
        datasets: [{
            data: [percentage, 100 - percentage],
            backgroundColor: ['#9B5BDC', '#e0e0e0'],  // Primary color and light gray for remaining
            hoverBackgroundColor: ['#808080', '#e0e0e0']
        }]
    };

    const options = {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 70,
        animation: {
            animateScale: true,
            animateRotate: true
        },
        plugins: {
            tooltip: {
                enabled: false
            }
        }
    };

    const myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options
    });

    document.getElementById('chartCenterText').innerText = percentage + '%';
});
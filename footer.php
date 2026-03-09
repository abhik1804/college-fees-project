</div> <!-- main close -->

<script>
function toggleDark(){
    document.body.classList.toggle("dark");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('collectionChart').getContext('2d');

var collectionChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Total Collection (₹)',
            data: <?php echo json_encode($totals); ?>,
            backgroundColor: '#2563eb'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>
</body>
</html>
<?php
include "db.php";
include "header.php";

/* Total Students */
$student_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
$student_data = mysqli_fetch_assoc($student_query);
$total_students = $student_data['total'];

/* Total Collection */
$amount_query = mysqli_query($conn, "SELECT SUM(amount) as total_amount FROM fees");
$amount_data = mysqli_fetch_assoc($amount_query);
$total_amount = $amount_data['total_amount'];
if($total_amount == "") $total_amount = 0;

/* Today Collection */
$today = date("Y-m-d");
$today_query = mysqli_query($conn,"
SELECT SUM(amount) as today_total 
FROM fees 
WHERE date='$today'
");
$today_data = mysqli_fetch_assoc($today_query);
$today_total = $today_data['today_total'];
if($today_total == "") $today_total = 0;

/* This Month Collection */
$current_month = date("Y-m");
$month_query = mysqli_query($conn,"
SELECT SUM(amount) as month_total 
FROM fees 
WHERE date LIKE '$current_month%'
");
$month_data = mysqli_fetch_assoc($month_query);
$month_total = $month_data['month_total'];
if($month_total == "") $month_total = 0;

/* Date Wise Collection */
$date_query = mysqli_query($conn,"
SELECT date, SUM(amount) as total 
FROM fees 
GROUP BY date 
ORDER BY date ASC
");

$dates = [];
$dateTotals = [];

while($row = mysqli_fetch_assoc($date_query)){
    $dates[] = $row['date'];
    $dateTotals[] = $row['total'];
}

/* Course Wise Collection */
$course_query = mysqli_query($conn,"
SELECT course, SUM(amount) as total 
FROM fees 
GROUP BY course
");

$courses = [];
$courseTotals = [];

while($row = mysqli_fetch_assoc($course_query)){
    $courses[] = $row['course'];
    $courseTotals[] = $row['total'];
}
?>

<h2>Dashboard Overview</h2>

<div class="card-container">

    <div class="stat-card blue">
        <h3>Total Students</h3>
        <h2 class="counter" data-target="<?php echo $total_students; ?>">0</h2>
    </div>

    <div class="stat-card green">
        <h3>Total Collection</h3>
        <h2 class="counter" data-target="<?php echo $total_amount; ?>">0</h2>
    </div>

    <div class="stat-card" style="background:#f59e0b;">
        <h3>Today Collection</h3>
        <h2 class="counter" data-target="<?php echo $today_total; ?>">0</h2>
    </div>

    <div class="stat-card" style="background:#9333ea;">
        <h3>This Month Collection</h3>
        <h2 class="counter" data-target="<?php echo $month_total; ?>">0</h2>
    </div>

</div>

<!-- Date Wise Chart -->
<div style="background:white;padding:25px;margin-top:30px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.05);">
    <h3>Date Wise Collection</h3>
    <canvas id="dateChart"></canvas>
</div>

<!-- Course Wise Chart -->
<div style="background:white;padding:25px;margin-top:30px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.05);">
    <h3>Course Wise Collection</h3>
    <canvas id="courseChart"></canvas>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/* Animated Counter */
const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    counter.innerText = '0';

    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const current = +counter.innerText;
        const increment = target / 100;

        if(current < target){
            counter.innerText = Math.ceil(current + increment);
            setTimeout(updateCounter, 20);
        } else {
            counter.innerText = target;
        }
    };

    updateCounter();
});

/* Date Wise Bar Chart */
var ctx1 = document.getElementById('dateChart').getContext('2d');

new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Total Collection (₹)',
            data: <?php echo json_encode($dateTotals); ?>,
            backgroundColor: '#2563eb'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

/* Course Wise Pie Chart */
var ctx2 = document.getElementById('courseChart').getContext('2d');

new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($courses); ?>,
        datasets: [{
            data: <?php echo json_encode($courseTotals); ?>,
            backgroundColor: [
                '#2563eb',
                '#16a34a',
                '#f59e0b',
                '#dc2626',
                '#9333ea'
            ]
        }]
    },
    options: {
        responsive: true
    }
});

</script>

<?php include "footer.php"; ?>
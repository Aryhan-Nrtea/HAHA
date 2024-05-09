<?php
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] : date("Y-m-d", strtotime(date("Y-m-d") . " -7 days"));
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] : date("Y-m-d");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['userdata'];
$user_id = $user['id'];

// Retrieve budget and expenses data from the database based on the selected date range
$budget_expenses_data = array();
$date_range_query = $conn->query("SELECT DISTINCT DATE_FORMAT(date_created, '%Y-%m-%d') AS date FROM `running_balance` WHERE category_id IN (SELECT id FROM categories WHERE status = 1 AND user_id = $user_id) AND DATE_FORMAT(date_created, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end' ORDER BY date_created ASC");
while ($date_row = $date_range_query->fetch_assoc()) {
    $date = $date_row['date'];
    // Retrieve total budget for the date
    $budget_query = $conn->query("SELECT IFNULL(SUM(balance), 0) AS total_budget FROM `categories` WHERE status = 1 AND user_id = $user_id");
    $budget_row = $budget_query->fetch_assoc();
    $total_budget = floatval($budget_row['total_budget']);
    // Retrieve total expenses for the date
    $expenses_query = $conn->query("SELECT IFNULL(SUM(amount), 0) AS total_expenses FROM `running_balance` WHERE category_id IN (SELECT id FROM categories WHERE status = 1 AND user_id = $user_id) AND DATE_FORMAT(date_created, '%Y-%m-%d') = '$date' AND balance_type = 2");
    $expenses_row = $expenses_query->fetch_assoc();
    $total_expenses = floatval($expenses_row['total_expenses']);
    // Add data to the array
    $budget_expenses_data[$date] = array(
        'budget' => $total_budget,
        'expenses' => $total_expenses
    );
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


</head>

<body>
  <style>
    .info-tooltip,
    .info-tooltip:focus,
    .info-tooltip:hover {
      background: unset;
      border: unset;
      padding: unset;
    }
  </style>
  <h1>Welcome to <?php echo $_settings->info('name') ?></h1>
  <hr>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Overall Alloted Budget</span>
          <span class="info-box-number text-right">
            <?php
            $cur_bul = $conn->query("SELECT SUM(balance) AS total 
                                                 FROM `categories` 
                                                 WHERE status = 1 
                                                   AND user_id = $user_id")
              ->fetch_assoc()['total'];
            echo number_format($cur_bul);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-day"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Expenses</span>
          <span class="info-box-number text-right">
            <?php
            $today_expense = $conn->query("SELECT SUM(amount) AS total 
                                                       FROM `running_balance` 
                                                       WHERE category_id IN (SELECT id FROM categories WHERE status = 1 AND user_id = $user_id) 
                                                         AND DATE(date_created) = '" . date("Y-m-d") . "' 
                                                         AND balance_type = 2 ")
              ->fetch_assoc()['total'];
            echo number_format($today_expense);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h4>Alloted Budget in each Categories</h4>
      <hr>
    </div>
  </div>
  <div class="col-md-12 d-flex justify-content-center">
    <div class="input-group mb-3 col-md-5">
      <input type="text" class="form-control" id="search" placeholder="Search Category">
      <div class="input-group-append">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
      </div>
    </div>
  </div>
  <div class="row row-cols-4 row-cols-sm-1 row-cols-md-4 row-cols-lg-4">
    <?php
    $categories = $conn->query("SELECT * FROM `categories` WHERE status = 1 AND user_id = $user_id ORDER BY `category` ASC");
    while ($row = $categories->fetch_assoc()) :
    ?>
      <div class="col p-2 cat-items">
        <div class="callout callout-info">
          <span class="float-right ml-1">
            <button type="button" class="btn btn-secondary info-tooltip" data-toggle="tooltip" data-html="true" title='<?php echo (html_entity_decode($row['description'])) ?>'>
              <span class="fa fa-info-circle text-info"></span>
            </button>
          </span>
          <h5 class="mr-4"><b><?php echo $row['category'] ?></b></h5>
          <div class="d-flex justify-content-end">
            <b><?php echo number_format($row['balance']) ?></b>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <div class="col-md-12">
    <h3 class="text-center" id="noData" style="display:none">No Data to display.</h3>
  </div>
  <hr>

      <!-- Chart to track budget and expenses -->
    <div class="row">
        <div class="col-lg-12">
            <h4>Graph</h4>

            <div class="card-body">
        <form id="filter-form">
            <div class="row align-items-end">
                <div class="form-group col-md-3">
                    <label for="date_start">Date Start</label>
                    <input type="date" class="form-control form-control-sm" name="date_start" value="<?php echo date("Y-m-d", strtotime($date_start)) ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_start">Date End</label>
                    <input type="date" class="form-control form-control-sm" name="date_end" value="<?php echo date("Y-m-d", strtotime($date_end)) ?>">
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-success btn-sm" type="button" id="printBTN"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </form>
        <hr>
        <div id="printable">
            <div>
                <h4 class="text-center m-0"><?php echo $_settings->info('name') ?></h4>
                <h3 class="text-center m-0"><b>Budget and Expense Graph</b></h3>
                <hr style="width:15%">
                <p class="text-center m-0">Date Between <b><?php echo date("M d, Y", strtotime($date_start)) ?> and <?php echo date("M d, Y", strtotime($date_end)) ?></b></p>
                <hr>
            </div>

       
    
            <canvas id="budgetVsExpensesChart" width="400" height="200"></canvas>
        </div>
    </div>
    
  <script>

// Use PHP to echo the budget and expenses data as JSON for JavaScript usage
var budgetExpensesData = <?php echo json_encode($budget_expenses_data); ?>;
        // Prepare labels and datasets for Chart.js
        var labels = Object.keys(budgetExpensesData);
        var budgetData = [];
        var expensesData = [];
        labels.forEach(function(date) {
            budgetData.push(budgetExpensesData[date].budget);
            expensesData.push(budgetExpensesData[date].expenses);
        });
        // Draw Chart.js
        var ctx = document.getElementById('budgetVsExpensesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Budget',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    data: budgetData,
                }, {
                    label: 'Expenses',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    data: expensesData,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        $(document).ready(function() {
            $('#filter-form').submit(function(e) {
                e.preventDefault()
                location.href = "./?home.php/&date_start=" + $('[name="date_start"]').val() + "&date_end=" + $('[name="date_end"]').val()
        })

            $('#printBTN').click(function() {
                var rep = $('#printable').clone();
                var ns = $('head').clone();
                rep.prepend(ns)
                var nw = window.document.open('', '_blank', 'width=900,height=600')
                nw.document.write(rep.html())
                nw.document.close()
                setTimeout(function() {
                    nw.print()
                    setTimeout(function() {
                        nw.close()
                    }, 500)
                }, 500)
            });
        });


    function check_cats() {
      if ($('.cat-items:visible').length > 0) {
        $('#noData').hide('slow')
      } else {
        $('#noData').show('slow')
      }
    }
    $(function() {
      $('[data-toggle="tooltip"]').tooltip({
        html: true
      })
      check_cats()
      $('#search').on('input', function() {
        var _f = $(this).val().toLowerCase()
        $('.cat-items').each(function() {
          var _c = $(this).text().toLowerCase()
          if (_c.includes(_f) == true)
            $(this).toggle(true);
          else
            $(this).toggle(false);
        })
        check_cats()
      })
    })
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME 5.10 -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- CUSTOM STYLE SHEET -->
    <link rel="stylesheet" href="./style/style.css">
    <title>TRANSACTION TRACKER</title>
</head>

<body>

    <!-- INSERT DATA FORM -->
    <?php require_once "./templates/process.php"; ?>

    <!-- RECORD ALERT -->
    <?php if (isset($_SESSION["message"])): ?>
    <div class="alert alert-<?= $_SESSION["msg_type"] ?>">
        <?php
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
            ?>
    </div>
    <?php endif; ?>
    <!-- END RECORD ALERT -->

    <!-- FORM SECTION -->
    <div class="container mt-4 p-4">
        <form action="./templates/process.php" method="POST">
            <div class="text-uppercase">
                <div class="form-group">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>">
                </div>
                <div class="form-group">
                    <input type="date" name="date" class="form-control" value="<?php echo $dateObj; ?>" required>
                </div>
                <div class="form-group">
                    <select class="form-control text-uppercase" name="category" value="<?php echo $categoryObj; ?>"
                        required>
                        <option disabled selected>SELECT CATEGORY</option>
                        <option value="income">income</option>
                        <option value="food">food</option>
                        <option value="transport">transport</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="amount" class="form-control" value="<?php echo $amountObj; ?>" required>
                </div>
            </div>
            <?php if ($update == true): ?>
            <button name="update" class="btn btn-outline-info form-control">UPDATE</button>
            <?php else: ?>
            <button name="submit" class="btn btn-outline-success form-control">SAVE</button>
            <?php endif; ?>
        </form>
        <!-- END DATA FORM -->
    </div>

    <!-- END FORM SECTION -->


    <?php
    ($connection = new mysqli("localhost", "root", "", "crud")) or
      die(mysqli_error($connection));

    // GETTING DATA BASED ON THERE FROM THE USER DATA TABLE
    $sql = "SELECT * FROM data ORDER BY id";

    // MAKING THE QUERY REQUEST
    $result = mysqli_query($connection, $sql);

    // GETTING THE REQUESTED RESULT AS AN ASSOCIATIVE ARRAY
    $datalists = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // EMPTY ARRAY'S TO STORE DEBIT CREDIT
    $debit = [];
    $credit = [];

    // COUNTING TOTAL NUMBERS OF DEBIT & CREDIT IN THE DATABASE
    foreach ($datalists as $data) {
      if ($data["category"] === "income") {
        array_push($debit, $data["amount"]);
      } else {
        array_push($credit, $data["amount"]);
      }
    }
    ?>


    <div class="container  container-fluid  px-4 text-muted text-center text-capitalize">
        <p class="h1">Transaction Summary</p>
        <div class="row gx-5">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="p-3 border bg-light">Total Debit : <?php echo array_sum(
                  $debit
                ); ?></div>
            </div>
            <!-- <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="p-3 border bg-light">transaction tracker</div>
            </div> -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="p-3 border bg-light">Total Credit : <?php echo array_sum(
                  $credit
                ); ?></div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 mt-2">
                <div class="p-3 border bg-light">Total Balance : <?php echo array_sum(
                  $debit
                ) - array_sum($credit); ?></div>
            </div>
        </div>
    </div>



    <?php
    $sql_month =
      "select * from data where created_at > DATE_ADD(NOW(),INTERVAL -1 MONTH) order by id";

    // MAKING THE QUERY REQUEST
    $result_month = mysqli_query($connection, $sql_month);

    // GETTING THE REQUESTED RESULT AS AN ASSOCIATIVE ARRAY
    $datalists_month = mysqli_fetch_all($result_month, MYSQLI_ASSOC);

    // EMPTY ARRAY'S TO STORE DEBIT CREDIT
    $debit_month = [];
    $credit_month = [];

    // COUNTING TOTAL NUMBERS OF DEBIT & CREDIT IN THE DATABASE
    foreach ($datalists_month as $data) {
      if ($data["category"] === "income") {
        array_push($debit_month, $data["amount"]);
      } else {
        array_push($credit_month, $data["amount"]);
      }
    }
    ?>


    <div class="container container-fluid px-4 text-muted text-center text-capitalize mt-4">
        <p class="h2">Transaction Summary for Last Month</p>

        <div class="row gx-5">

            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="p-3 border bg-light">Total Debit : <?php echo array_sum(
                  $debit_month
                ); ?></div>
            </div>
            <!-- <div class="col-sm-12 col-md-2 col-lg-3">
                <div class="p-3 border bg-light">transaction in a month</div>
            </div> -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="p-3 border bg-light">Total Credit : <?php echo array_sum(
                  $credit_month
                ); ?></div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="p-3 border bg-light">Total Balance : <?php echo array_sum(
                  $debit_month
                ) - array_sum($credit_month); ?></div>
            </div>
        </div>
    </div>



    <?php
    $query = "SELECT DISTINCT category from data";
    $categories = mysqli_fetch_all(
      mysqli_query($connection, $query),
      MYSQLI_ASSOC
    );

    // GETTING DATA BASED ON THERE FROM THE USER DATA TABLE
    $sql = "SELECT * FROM data ORDER BY id";

    // MAKING THE QUERY REQUEST
    $result = mysqli_query($connection, $sql);

    // GETTING THE REQUESTED RESULT AS AN ASSOCIATIVE ARRAY
    $datalists = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>



    <section class="main-section text-uppercase text-center">
        <div class="container container-fluid">
            <div class="row d-flex text-center">
                <button type="button"
                    class='all_tran category-button text-uppercase btn btn1 btn-sm btn-outline-info form-control active'>All
                    Transactions</button>

                <?php foreach ($categories as $category): ?>
                <button type="button"
                    class='category-button text-uppercase btn btn1 btn-sm btn-outline-info form-control <?php echo "{$category["category"]}"; ?>'><?php echo $category[
  "category"
]; ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="main-section text-uppercase all_tran tran">
        <!-- DATA SECTION -->
        <div class="container px-4 mt-3 container-fluid">
            <table style="width:100%" class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($datalists as $data): ?>

                <?php
                    $id = $data["id"];
                    $amount = $data["amount"];
                    $category = $data["category"];
                    $date = date("m-d-Y", strtotime($data["created_at"]));
                    ?>

                <tr>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $category; ?></td>
                    <td>
                        <?php if ($data["category"] === "income") {
                              echo "DEBIT";
                            } else {
                              echo "CREDIT";
                            } ?>
                    </td>
                    <td><?php echo $amount; ?></td>
                    <td> <a href="index.php?edit=<?php echo $id; ?>"
                            class="btn1 btn btn-warning text-capitalize m-0">update</a>

                        <a href="./templates/process.php?delete=<?php echo $id; ?>" name="delete"
                            class="btn1 btn btn-danger text-capitalize m-0">delete</a>
                    </td>
                </tr>

                <!-- <div class="items">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light"></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light"></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light">$: </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-2 border bg-light">

 

                        </div>
                    </div>
                </div>
            </div> -->
                <?php endforeach; ?>
            </table>
        </div>
        <!-- END DATA SECTION -->
    </section>

    <?php foreach ($categories as $category):

      // GETTING DATA BASED ON THERE FROM THE USER DATA TABLE
      $sql = "SELECT * FROM data WHERE category = '{$category["category"]}' ORDER BY id";

      // MAKING THE QUERY REQUEST
      $result = mysqli_query($connection, $sql);

      // GETTING THE REQUESTED RESULT AS AN ASSOCIATIVE ARRAY
      $datalists = mysqli_fetch_all($result, MYSQLI_ASSOC);
      ?>
    <section class="main-section text-uppercase sub_tran tran <?php echo "{$category["category"]}"; ?>">
        <!-- DATA SECTION -->
        <div class="container px-4 mt-3 container-fluid">
            <table style="width:100%" class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($datalists as $data): ?>

                <?php
                        $id = $data["id"];
                        $amount = $data["amount"];
                        $category = $data["category"];
                        $date = date("m-d-Y", strtotime($data["created_at"]));
                        ?>

                <tr>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $category; ?></td>
                    <td>
                        <?php if ($data["category"] === "income") {
                                  echo "DEBIT";
                                } else {
                                  echo "CREDIT";
                                } ?>
                    </td>
                    <td><?php echo $amount; ?></td>
                    <td> <a href="index.php?edit=<?php echo $id; ?>"
                            class="btn1 btn btn-warning text-capitalize m-0">update</a>

                        <a href="./templates/process.php?delete=<?php echo $id; ?>" name="delete"
                            class="btn1 btn btn-danger text-capitalize m-0">delete</a>
                    </td>
                </tr>

                <!-- <div class="items">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light"></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light"></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light">$: </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-2 border bg-light">

 

                        </div>
                    </div>
                </div>
            </div> -->
                <?php endforeach; ?>
            </table>
        </div>
        <!-- END DATA SECTION -->
    </section>

    <?php
    endforeach; ?>





    <!-- SCRIPTS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": true,
            "ordering": true,
            "info": true
        });
    });
    $(".sub_tran").hide();

    $(".category-button").click(function() {
        $(".category-button").removeClass('active');
        $(this).addClass('active');
        $(".tran").hide();
        if ($(this).hasClass("food")) {
            $(".food").show();
        }
        if ($(this).hasClass("income")) {
            $(".income").show();
        }
        if ($(this).hasClass("transport")) {
            $(".transport").show();
        }
        if ($(this).hasClass("all_tran")) {
            $(".all_tran").show();
        }
    });
    </script>
</body>

</html>
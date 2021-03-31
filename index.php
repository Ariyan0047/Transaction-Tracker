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
    <!-- CUSTOM STYLE SHEET -->
    <title>TRANSACTION TRACKER</title>
</head>

<body>

    <!-- INSERT DATA FORM -->
    <?php require_once "./templates/process.php"; ?>
    <div class="container mt-4 p-4">
        <form action="./templates/process.php" method="POST">
            <div class="text-uppercase">
                <div class="form-group">
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <select class="form-control text-uppercase" name="category" required>
                        <option disabled selected>SELECT CATEGORY</option>
                        <option value="income">income</option>
                        <option value="food">food</option>
                        <option value="transport">transport</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="amount" class="form-control" required>
                </div>
            </div>
            <input type="submit" name="submit" value="SAVE" class="btn btn-outline-success form-control">
        </form>
        <!-- END DATA FORM -->
    </div>

    <?php
    include "./connection.php";
    // GETTING DATA BASED ON THERE FROM THE USER DATA TABLE
    $sql = "SELECT * FROM data ORDER BY id";

    // MAKING THE QUERY REQUEST
    $result = mysqli_query($connection, $sql);

    // GETTING THE REQUESTED RESULT AS AN ASSOCIATIVE ARRAY
    $datalists = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>

    <section class="main-section text-uppercase">

        <!-- INCLUDING HEADER AND NAVBAR -->
        <?php
// include "./templates/header.php";
?>
        <!-- END HEADER AND NAVBAR -->

        <!-- DATA SECTION -->
        <div class="container px-4 mt-3">
            <?php foreach ($datalists as $data): ?>

            <?php
            $id = $data["id"];
            $amount = $data["amount"];
            $category = $data["category"];
            $date = date("m-d-Y", strtotime($data["created_at"]));
            ?>

            <div class="items">
                <div class="row gx-5 align-items-center justify-content-md-center">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light"><?php echo $date; ?></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light"><?php echo $category; ?></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-3 border bg-light">$: <?php echo $amount; ?></div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="p-2 border bg-light">


                            <a href="" class="btn1 btn btn-warning text-uppercase">update</a>

                            <a href="" name="delete" class="btn1 btn btn-danger text-uppercase">delete</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- END DATA SECTION -->
    </section>






    <!-- SCRIPTS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
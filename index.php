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
    <form action="index.php" method="POST" class="container">
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
        <input type="submit" name="submit" value="SAVE" class="btn btn-outline-success w-50">
    </form>





    <!-- SCRIPTS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
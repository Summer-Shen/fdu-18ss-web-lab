<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here
try {
    $connString = "mysql:host=localhost;dbname=travel";
    $user = "root";
    $pass = "Zs9tpi18south";
    $pdo = new PDO($connString, $user, $pass);

    $sql_1 = "SELECT * FROM Continents";
    $result_continents = $pdo->query($sql_1);

    $sql_2 = "SELECT * FROM Countries";
    $result_countries = $pdo->query($sql_2);

    $sql_3 = "SELECT * FROM ImageDetails";
    $result_image_details = $pdo->query($sql_3);

    if (isset($_GET['continent'])) {
        $continent_input = $_GET['continent'];
    } else {
        $continent_input = "0";
    }
    if (isset($_GET['country'])) {
        $country_input = $_GET['country'];
    } else {
        $country_input = "0";
    }

} catch (PDOException $e) {
    die($e->getMessage());
} finally {
    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>


    <link rel="stylesheet" href="css/captions.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.css"/>

</head>

<body>
<?php include 'header.inc.php'; ?>


<!-- Page Content -->
<main class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Filters</div>
        <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
                <div class="form-inline">
                    <select name="continent" class="form-control">
                        <option value="0">Select Continent</option>
                        <?php
                        //Fill this place

                        //****** Hint ******
                        //display the list of continents

                        while ($row = $result_continents->fetch()) {
                            echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                        }

                        ?>
                    </select>

                    <select name="country" class="form-control">
                        <option value="0">Select Country</option>
                        <?php
                        //Fill this place

                        //****** Hint ******
                        /* display list of countries */

                        while ($row = $result_countries->fetch()) {
                            echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                        }


                        ?>
                    </select>
                    <input type="text" placeholder="Search title" class="form-control" name=title>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

        </div>
    </div>


    <ul class="caption-style-2">
        <?php
        //Fill this place

        //****** Hint ******
        /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
        <li>
          <a href="detail.php?id=????" class="img-responsive">
            <img src="images/square-medium/????" alt="????">
            <div class="caption">
              <div class="blur"></div>
              <div class="caption-text">
                <p>????</p>
              </div>
            </div>
          </a>
        </li>
        */

        $result_exists = false;
        while ($row = $result_image_details->fetch()) {
            if (($continent_input == '0' | $continent_input == $row['ContinentCode']) &
                ($country_input == '0' | $country_input == $row['CountryCodeISO']) ) {
                $result_exists = true;

                $id = $row['ImageID'];
                $src = $row['Path'];
                $title = $row['Title'];

                echo "
            <li>
              <a href=\"detail.php?id=$id\" class=\"img-responsive\">
                <img src=\"images/square-medium/$src\" alt=\"$title\" style=\"width: 225px; height: 225px\">
                <div class=\"caption\">
                  <div class=\"blur\"></div>
                  <div class=\"caption-text\">
                    <p>$title</p>
                  </div>
                </div>
              </a>
            </li>";

            }
        }

        if (!$result_exists) {
            echo "<div class=\"text-center\">Result doesn't exist! Please try again.</div>";
        }

        ?>
    </ul>


</main>

<footer>
    <div class="container-fluid">
        <div class="row final">
            <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
            <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
        </div>
    </div>


</footer>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
</body>

</html>
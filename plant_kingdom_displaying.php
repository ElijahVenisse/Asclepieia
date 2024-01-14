<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Kingdom Display</title>
    <style>
         body {
            background-image: url('logo/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        #header-container {
            text-align: center;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 50px auto;
            max-width: 800px;
            color: #435d56;
        }

        h2 {
            color: #007bff;
        }

        h3 {
            color: #28a745;
        }

       

        li {
            margin-bottom: 8px;
        }

        .form-container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container">
        <h2>Plant Kingdom </h2>

        <div class="form-container">
            <form action="plant_kingdom_displaying.php" method="post">
                <label for="kingdom">Select Kingdom:</label>
                <select name="kingdom" id="kingdom">
                <option value="select">-----Select-----</option>
                    <option value="Thallophyta">Thallophyta</option>
                    <option value="Bryophyta">Bryophyta</option>
                    <option value="Pteridophyta">Pteridophyta</option>
                    <option value="Gymnosperms">Gymnosperms</option>
                    <option value="Angiosperms">Angiosperms</option>
                </select>
                <button type="submit">Display</button>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedKingdom = $_POST['kingdom'];
            $data = readPlantData();

            if (isset($data['kingdoms'][$selectedKingdom])) {
                $description = $data['kingdoms'][$selectedKingdom]['description'];
                $characteristics = $data['kingdoms'][$selectedKingdom]['characteristics'];
                $classification = $data['kingdoms'][$selectedKingdom]['classification'];


                // echo '<h3> What is ' . $selectedKingdom ' ? </h3>';
                echo "<h3>$selectedKingdom</h3>";
                echo "<p>Description: $description</p>";

                echo "<h4><strong>Characteristics:</strong></h4>";
                echo "<ul>";
                foreach ($characteristics as $characteristic) {
                    echo "<li>$characteristic</li>";
                }
                echo "</ul>";

                echo "<h4><strong>Classification:</strong></h4>";
                echo "<ul>";
                foreach ($classification as $class) {
                    echo "<li>";
                    echo "<strong>$class[name]:</strong> $class[description]";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Kingdom not found.</p>";
            }
        }

        function readPlantData() {
            $jsonFile = 'nav_kingdom.json';
            $jsonString = file_get_contents($jsonFile);
            return json_decode($jsonString, true);
        }
        ?>
    </div>
</body>
</html>

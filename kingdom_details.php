<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Kingdom Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add any additional stylesheets or meta tags as needed -->
    <style>
        /* Add any additional CSS styles as needed */
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-3">
    <?php
    // Check if the 'plant_name' parameter is set in the URL
    if (isset($_GET['plant_name'])) {
        $plantName = urldecode($_GET['plant_name']);
        
        // Load kingdom.json data
        $kingdomData = file_get_contents('kingdom.json');

        if ($kingdomData === false) {
            echo '<p>Error reading kingdom.json.</p>';
        } else {
            $kingdomData = json_decode($kingdomData, true);

            if ($kingdomData === null) {
                echo '<p>Error decoding JSON data.</p>';
            } else {
                // Check if the plant name exists in kingdom.json
                if (isset($kingdomData[$plantName])) {
                    $kingdomInfo = $kingdomData[$plantName];
                    echo '<h2> Scientific classification of ' . $plantName . '</h2>';
                    
                    // Display Kingdom if it exists
                    if (isset($kingdomInfo['Kingdom'])) {
                        echo '<p>Kingdom: ' . $kingdomInfo['Kingdom'] . '</p>';
                    }
                    
                    // Display Clade if it exists
                    if (isset($kingdomInfo['Clade'])) {
                        echo '<p><strong>Clade:</strong> ' . implode(', ', $kingdomInfo['Clade']) . '</p>';
                    }
                    
                    // Display Order if it exists
                    if (isset($kingdomInfo['Order'])) {
                        echo '<p><strong>Order:</strong> ' . $kingdomInfo['Order'] . '</p>';
                    }
                    
                    // Display Family if it exists
                    if (isset($kingdomInfo['Family'])) {
                        echo '<p><strong>Family:</strong> ' . $kingdomInfo['Family'] . '</p>';
                    }
                    
                    // Display Genus if it exists
                    if (isset($kingdomInfo['Genus'])) {
                        echo '<p><strong>Genus:</strong> ' . $kingdomInfo['Genus'] . '</p>';
                    }

                    // Display Binomial name if it exists
                    if (isset($kingdomInfo['Binomial name'])) {
                        echo '<p><strong>Binomial name:</strong> ' . $kingdomInfo['Binomial name'] . '</p>';
                    }
                    
                    // You can continue displaying other kingdom information...
                } else {
                    echo '<p>Plant information not found.</p>';
                }
            }
        }
    } else {
        echo '<p>Plant name not provided.</p>';
    }
    ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($_GET['plant_name'])) {
    $plantName = urldecode($_GET['plant_name']);
    
    // Load kingdom.json data
    $kingdomData = file_get_contents('kingdom.json');

    if ($kingdomData !== false) {
        $kingdomData = json_decode($kingdomData, true);

        if ($kingdomData !== null && isset($kingdomData[$plantName])) {
            $kingdomInfo = $kingdomData[$plantName];
            echo '<h2>Kingdom Information for ' . $plantName . '</h2>';
            echo '<p>Kingdom: ' . $kingdomInfo['kingdom'] . '</p>';
            echo '<p><strong>Order:</strong> ' . $kingdomInfo['order'] . '</p>';
            echo '<p><strong>Family:</strong> ' . $kingdomInfo['family'] . '</p>';
            echo '<p><strong>Genus:</strong> ' . $kingdomInfo['genus'] . '</p>';
            // Additional kingdom details go here
        } else {
            echo '<p>Plant information not found.</p>';
        }
    } else {
        echo '<p>Error reading kingdom.json.</p>';
    }
} else {
    echo '<p>Plant name not provided.</p>';
}
?>

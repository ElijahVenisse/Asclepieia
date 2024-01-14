<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $plantName = $_POST['plant_name'];
    $comment = $_POST['comment'];

    // Load JSON data
    $plantDataFile = 'plant_json.json';
    $jsonContent = file_get_contents($plantDataFile);
    $herbData = json_decode($jsonContent, true);

    // Find the plant in the data
    foreach ($herbData['herb'] as &$plant) {
        if ($plant['name'] === $plantName) {
            // Add comment to the plant data
            if (!isset($plant['comments'])) {
                $plant['comments'] = array();
            }
            $newComment = array(
                'user' => $_SESSION['username'],
                'text' => $comment,
                'timestamp' => date('Y-m-d H:i:s')
            );
            $plant['comments'][] = $newComment;
            break;
        }
    }

    // Save updated data back to the JSON file
    file_put_contents($plantDataFile, json_encode($herbData, JSON_PRETTY_PRINT));

    // Redirect back to the homepage
    if ($_POST['plantDetailComment']) header("Location: plant_details.php?id=$id");
    else header("Location: homepage.php");
    exit();
}
?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            // AJAX request on form submission
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                
                var formData = $(this).serialize(); // Serialize form data
                var url = $(this).attr('action'); // Get form action URL

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Update comment section with the refreshed comments
                        $('.comment-list').html(response); // Assuming the response contains updated comments HTML
                    },
                    error: function() {
                        console.log('Error submitting comment');
                    }
                });
            });
        });
    </script>
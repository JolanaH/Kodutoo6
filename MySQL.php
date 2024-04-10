<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kodutöö 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <h1>Kodutöö nr6</h1>
    <h2>Tickets</h2><br>

    <?php
    include("config.php");

    function formatDateForSQL($date) {
        return date('Y-m-d', strtotime($date));
    }

    
    
    
    $sqlResolvedTickets = "SELECT * FROM `tickets` WHERE `status` = 'Resolved'";
    $resultResolvedTickets = mysqli_query($yhendus, $sqlResolvedTickets);

    echo '<div class="mb-4">';
    echo '<h1>All Resolved Tickets</h1>';

    if ($resultResolvedTickets && mysqli_num_rows($resultResolvedTickets) > 0) {
        while ($rowResolved = mysqli_fetch_assoc($resultResolvedTickets)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $rowResolved['issue_description'] . '</h5>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<h3>No Resolved Tickets Found</h3>';
        echo '<p class="small-font">No resolved tickets were found.</p>';
    }
    echo '</div>';

    
    
    
    $sqlAvgDuration = "SELECT AVG(estimated_duration_hours) AS avg_duration FROM `tickets` WHERE `status` = 'Open'";
    $resultAvgDuration = mysqli_query($yhendus, $sqlAvgDuration);

    echo '<div class="mb-4">';
    echo '<h1>Average Estimated Duration for Open Tickets</h1>';

    if ($resultAvgDuration && mysqli_num_rows($resultAvgDuration) > 0) {
        $rowAvg = mysqli_fetch_assoc($resultAvgDuration);
        $avgDuration = round($rowAvg['avg_duration'], 2);

        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Average Estimated Duration:</h5>';
        echo '<p class="card-text">' . $avgDuration . ' hours</p>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<h3>Average Estimated Duration for Open Tickets:</h3>';
        echo '<p class="small-font">N/A</p>';
    }
    echo '</div>';


    
    
    $assignedTo = 'Luisa Caulliere';
    $sqlAssignedTickets = "SELECT * FROM `tickets` WHERE `assigned_to` = '$assignedTo'";
    $resultAssignedTickets = mysqli_query($yhendus, $sqlAssignedTickets);

    echo '<div class="mb-4">';
    echo '<h1>Tickets Assigned to ' . $assignedTo . '</h1>';

    if ($resultAssignedTickets && mysqli_num_rows($resultAssignedTickets) > 0) {
        while ($rowAssigned = mysqli_fetch_assoc($resultAssignedTickets)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $rowAssigned['issue_description'] . '</h5>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<h3>No Tickets Assigned to ' . $assignedTo . '</h3>';
        echo '<p class="small-font">None</p>';
    }
    echo '</div>';


    
    
    $creationDate = '2022-01-01';
    $formattedDate = formatDateForSQL($creationDate);
    $sqlOpenTicketsBeforeDate = "SELECT * FROM `tickets` WHERE `created_date` < '$formattedDate' AND `status` = 'Open'";
    $resultOpenTicketsBeforeDate = mysqli_query($yhendus, $sqlOpenTicketsBeforeDate);

    echo '<div class="mb-4">';
    echo '<h1>Open Tickets Created Before ' . $creationDate . '</h1>';

    if ($resultOpenTicketsBeforeDate && mysqli_num_rows($resultOpenTicketsBeforeDate) > 0) {
        while ($rowOpen = mysqli_fetch_assoc($resultOpenTicketsBeforeDate)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $rowOpen['issue_description'] . '</h5>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<h3>No Open Tickets Created Before ' . $creationDate . '</h3>';
        echo '<p class="small-font">None</p>';
    }
    echo '</div>';

    mysqli_close($yhendus);
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

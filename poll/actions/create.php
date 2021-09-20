<?php

require_once __DIR__ . '\..\..\vendor\autoload.php';

$createPollController = new \Poll\Controller\Create();
$pollHash = $createPollController->createPoll();
$resultLink = $_SERVER['SERVER_NAME'] . '/pollcreator/poll/view/vote.php?p=' . $pollHash;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poll Creator - Create</title>

        <link rel="stylesheet" href="../../assets/css/style.css">
        <script src="../../assets/js/jquery-3.6.0.min.js"></script>
        <script src="../../assets/js/actions/create.js"></script>

    </head>
    <body class="poll-creation-success-page">
        <div class="main-container creation-success-container">
            <div class="creation-success-inner-container">
                <h1 class="creation-success-title page-title">Creation Complete</h1>
                <div class="creation-content">
                    <p class="creation-message">Poll successfully created.</p>
                    <p class="creation-message vote-message">Vote or check results here:</p>
                    <input type="text" class="vote-link" value="<?php echo $resultLink ?>"/>
                    <button type="button" class="copy-link-button">Copy Link</button>
                </div>
            </div>
        </div>
        <div class="popup">
            <p class="popup-message"></p>
        </div>
    </body>
</html>
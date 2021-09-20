<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poll Creator - Create</title>

        <link rel="stylesheet" href="../../assets/css/style.css">
        <script src="../../assets/js/jquery-3.6.0.min.js"></script>
        <script src="../../assets/js/view/create.js"></script>

    </head>
    <body class="create-poll-page">
        <div class="main-container">
            <h1 class="create-poll-title page-title">Create a poll</h1>
            <div class="create-form-container">
                <form id="poll-form" class="create-form" method="post" action="../actions/create.php">
                    <label for="title">Poll title</label>
                    <input type="text" name="title" class="poll-title" placeholder="Enter title..." required/>
                    <p class="options-info">Options</p>
                    <div class="poll-options-container">
                        <div class="poll-option-container">
                            <input type="text" name="option[]" class="poll-option" placeholder="Enter option..." required/>
                            <button type="button" class="remove-button">Remove</button>
                        </div>
                        <div class="poll-option-container">
                            <input type="text" name="option[]" class="poll-option" placeholder="Enter option..." required/>
                            <button type="button" class="remove-button">Remove</button>
                        </div>
                        <div class="poll-option-container">
                            <input type="text" name="option[]" class="poll-option" placeholder="Enter option..." required/>
                            <button type="button" class="remove-button">Remove</button>
                        </div>
                        <div class="poll-option-container">
                            <input type="text" name="option[]" class="poll-option" placeholder="Enter option..." required/>
                            <button type="button" class="remove-button">Remove</button>
                        </div>
                    </div>
                    <div class="new-option-container">
                        <button type="button" class="add-new-option-button">New option</button>
                    </div>
                    <div class="number-of-days-container">
                        <label for="days">Number of days until poll is closed</label>
                        <div class="number-of-days-inner">
                            <input type="text" name="days" class="poll-days" value="1" readonly/>
                            <div class="number-of-days-control">
                                <button type="button" class="increment-day-button day-control-button"><span class="symbol">+</span></button>
                                <button type="button" class="decrement-day-button day-control-button"><span class="symbol">-</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="submit-container">
                    <input type="submit" class="submit-button" value="CREATE POLL">
                    </div>
                </form>
            </div>
        </div>
        <div class="popup">
            <p class="popup-message"></p>
        </div>
    </body>
</html>
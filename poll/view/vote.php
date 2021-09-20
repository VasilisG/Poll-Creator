<?php

require_once __DIR__ . '\..\..\vendor\autoload.php';

$pollFetch = new \Poll\Controller\PollFetch();
$poll = $pollFetch->getPoll();
$options = null;
if($poll != null){
    $options = $poll->getOptions();
}
else {
    header('Location: poll/view/create.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poll Creator - Vote</title>

        <link rel="stylesheet" href="../../assets/css/style.css">
        <script src="../../assets/js/jquery-3.6.0.min.js"></script>
        <script src="../../assets/js/actions/vote.js"></script>

    </head>
    <body>
        <?php if($poll->isActive()): ?>
            <div class="main-container vote-container">
                <div class="vote-inner-container">
                    <h1 class="page-title vote-title"><?php echo $poll->getTitle() ?></h1>
                    <form class="vote-options-container">
                        <div class="options-container <?php count($options) > 4 ? 'options-container-overflow' : ''?>">
                            <?php foreach($options as $option): ?>
                                <?php
                                    $id = $option->getId();
                                    $name = $option->getName();
                                    $optionId = strtolower($name) . '-' . $id;
                                ?>
                                <div class="vote-now option-container">
                                    <input type="radio" id="<?php echo $optionId ?>" class="vote-option" name="vote-option" value="<?php echo $name ?>" data-option-id="<?php echo $id ?>"/>
                                    <label class="option-label" for="<?php echo $optionId ?>"><?php echo $name ?></label></br>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="button" class="submit-button vote-button" value="SUBMIT VOTE"/>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="main-container vote-container">
                <div class="vote-inner-container">
                    <h1 class="page-title vote-title"><?php echo $poll->getTitle() ?></h1>
                    <div class="vote-options-container">
                        <div class="options-container <?php count($options) > 6 ? 'options-container-overflow' : ''?>">
                            <?php
                                $total = 0;
                                foreach($options as $option){
                                    $total += $option->getVotes();
                                }
                            ?> 
                            <?php foreach($options as $option): ?>
                                <?php
                                    $id = $option->getId();
                                    $name = $option->getName();
                                    $votes = $option->getVotes();
                                    $percent = round(($votes / $total) * 100, 1);
                                ?>
                                <div class="result option-container">
                                    <div class="option-stats">
                                        <span class="option-label"><?php echo $name ?></span>
                                        <span class="percent-number"><?php echo $percent . ' %' ?></span>
                                    </div>
                                   <div class="percent-container">
                                        <div class="percent" style="width: <?php echo $percent ?>%;"></div>
                                   </div>
                                   
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>
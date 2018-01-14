<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');

// echo out positive messages
if (isset($feedback_positive)){
    foreach ($feedback_positive as $feedback) {
        echo '<div style="margin: 0px;" class="alert alert-success alert-dismissible" style="margin-bottom = 0px;">'
        . '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                . $feedback
                . '</div>';
    }
}

// echo out negative messages
if (isset($feedback_negative)){
    foreach ($feedback_negative as $feedback) {
        echo '<div style="margin: 0px;" class="alert alert-danger alert-dismissible" style="margin-bottom = 0px;">'
        . '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                . $feedback
                . '</div>';
    }
}
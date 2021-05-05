<?php
function DateFormat($Date) {
    $Date = strtotime($Date);
    $Date = date('M jS, Y', $Date);
    return $Date;
}
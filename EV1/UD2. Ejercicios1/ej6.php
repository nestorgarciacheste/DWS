<?php
$n1 = 5;
$n2 = 6;
$result = $n1 <=> $n2;

switch ($result) {
    case 1:
        echo $n1 . " Es mayor que " . $n2;
        break;

    case -1:
        echo $n2 . " Es mayor que " . $n1;
        break;

    default:
        echo $n2 . " Es igual a " . $n1;
        break;
}

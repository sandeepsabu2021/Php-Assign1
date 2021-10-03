<?php
    $n1 = range(0,9);
    $n2 = range(9,1);
    $rn1 = array_rand($n1);
    $rn2 = array_rand($n2);

    $captcha = "$rn1 + $rn2 = ?";
    $capval = $rn1 + $rn2;
?>
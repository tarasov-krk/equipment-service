<?php

return [
    'name' => 'Equipment',

    'serial_number_mask_rules' => [
        "N" => "/\d/",
        "A" => "/[A-Z]/",
        "a" => "/[a-z]/",
        "X" => "/[A-Z\d]/",
        "Z" => "/[\-\_\@]/",
    ],
];

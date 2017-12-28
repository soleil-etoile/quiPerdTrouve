<?php
require 'includes/header.php';
  if(isset($_GET['s']) && !empty($_GET['s'])) {

    // ваша БД/API
    $countries = array(
        'Russia',
        'United Kingdom',
        'Germany',
    );

    $query = [];

    // Поиск в БД/API
    foreach($countries as $country) {
        preg_match_all("/(?<match>" . strtolower($_GET['s']) . ")" . "/", strtolower($country), $match, PREG_PATTERN_ORDER);
        if(count($match['match'])) {
            $query[] = $country;
        }
    }

    echo json_encode($query);
    die();
}
?>
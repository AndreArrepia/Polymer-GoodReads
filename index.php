<?php

require(__DIR__ . "/src/GoodRead.php");


$cache_dir = __DIR__  . "/cache/";
$query = (is_string($_GET["query"])) ? filter_input(INPUT_GET, "query") : "";
if (empty($query)) {
    $result = array(
        "Request" => array(
            'authentication' => 'false',
            'key' => array(),
            'method' => array()
        ),
        "search" => array(
            'query' => array (),
            'results-start' => '1',
            'results-end' => '0',
            'total-results' => '0',
            'source' => 'Goodreads',
            'query-time-seconds' => '0.00',
            'results' => array()
        )
    );
} else {

    if (!is_dir($cache_dir)) {
        mkdir($cache_dir, 0755);
    }

    $page = (isset($_GET["page"])) ? filter_input(INPUT_GET, "page") : 1;
    $field = (isset($_GET["field"])) ? filter_input(INPUT_GET, "field") : "all";

    $goodRead = new GoodRead("bZFY4Rc5TZpBEc89fv7XKA", $cache_dir);
    $result = $goodRead->search($query, $page, $field);
}

 echo json_encode($result);

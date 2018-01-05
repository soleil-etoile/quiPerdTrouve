 <form action="/server.php">
        <input type="text" name="s" class="js_input">
        <select name="country" class="js_select">
            <option>Не выбрано</option>
        </select>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="ajax.js"></script>
    
   
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
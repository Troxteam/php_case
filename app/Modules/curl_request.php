<?php
include_once '../Modules/utils.php';
// Handles curl setup and execution
function callApi($method, $url, $ids)
{
    $curl = curl_init();
    switch ($method) {
        case 'GET':
            // Appends the products api url
            $url = $url . "products.json";
            // If product ids have been provided appends the api url for specific products
            if ($ids) {
                $url = $url . "?ids=";
                // Appends product ids to the api url in the correct format
                foreach ($ids as $id) {
                    $url .= trim($id) . ',';
                }
            }
            break;

        default:
            echo "Request needs a method!!!";
            break;
    }

    // Sets curl options for getting the correct data
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    if (!$result) {
        console_log("Curl: Connection Failed!");
    }
    curl_close($curl);
    return $result;
}
 ?>

<?php
session_start();
include_once '../Modules/utils.php';
?>
<?php include '../Templates/header.php'; ?>
<?php include '../Modules/curl_request.php'; ?>

<?php
    global $response;
    $errors = '';
    // Check if get products button is pressed
    if (isset($_POST['callGet'])) {
        // If the user is connected to a store when get products is pressed, handle the api calls depending on if
        //  product ids are provided or not.
        if (isset($_SESSION['url'])) {
            if (!empty($_POST['productId'])) {
                $get_data = callApi('GET', $_SESSION['url'], explode(',', $_POST['productId']));
            } else {
                $get_data = callApi('GET', $_SESSION['url'], false);
            }
            // turn the json object into an array
            $response = json_decode($get_data, true);
            // if no products are returned from the api inform the user and log to console
            if (count($response['products']) == 0) {
                $errors = "Product Id not found";
                console_log($errors);
            }
        // if the user atempts to get products without having connected to a store, redirect them to the store connect page
        //  META tag is in case JS is disabled
        } else {
            console_log("Rederiected to connect to store");
            echo "<script type='text/javascript'>document.location.href='request.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . 'request.php' . '">';
        }
    }
?>

<section class="container brand-size">
    <form class="" action="index.php" method="post">
        <div class="center">
            <h5 class="grey-text text-darken-2">Product Id(All products if empty, comma separation for multiple items.):</h5>
            <input type="text" name="productId">
            <div class="red-text"><?php echo $errors; ?></div>
            <input type="submit" name="callGet" value="Get Products" class="btn brand">
        </div>
    </form>
</section>

<!-- Table html copied from the web -->
<section class="container">
    <div class="responsive-table table-status-sheet">
    <table class="bordered">
      <thead>
        <tr>
          <th class="id-text">Id.</th>
          <th class="center">Name</th>
          <th class="center">Description</th>
          <th class="center">Price</th>
        </tr>
      </thead>
      <tbody>
          <!-- If we have gotten a data from the server iterate through all products and their variants -->
          <!-- and put them into a scrollable table showing product id, name, description and price.    -->
          <?php if (isset($response)) : ?>
              <?php foreach ($response['products'] as $product): ?>
                  <?php foreach ($product['variants'] as $variant) : ?>
                  <tr>
                      <?php if (count($product['variants']) > 1) : ?>
                          <td class="id-text"><?php echo $product['id'] . '/' . $variant['id']; ?></td>
                          <td><?php echo $product['title'] . '(' . $variant['title'] . ')'; ?></td>
                      <?php else : ?>
                          <td class="id-text"><?php echo $product['id']; ?></td>
                          <td><?php echo $product['title']; ?></td>
                      <?php endif ?>
                      <td><?php echo $product['body_html']; ?></td>
                      <td><?php echo $variant['price']; ?></td>
                  </tr>
                <?php endforeach ?>
              <?php endforeach ?>
          <?php endif ?>
      </tbody>
    </table>
  </div>
</section>

<?php include '../Templates/footer.php'; ?>

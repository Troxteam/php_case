<?php
    // Enables $_SESSION variable
    session_start();
    include_once '../Modules/utils.php';

    $url = $key = $password = '';
    $errors = ['url'=>'', 'key'=>'', 'password'=>''];

    if (isset($_POST['submit'])) {
        if (empty($_POST['url'])) {
            $errors['url'] = "Missing URL!";
            console_log($errors['url']);
        } else {
            $url = $_POST['url'];
            $_SESSION['store'] = htmlspecialchars($url);
        }
        if (empty($_POST['key'])) {
            $errors['key'] = "key empty";
            console_log($errors['key']);
        } else {
            $key = $_POST['key'];
        }
        if (empty($_POST['password'])) {
            $errors['password'] = "password empty";
            console_log($errors['password']);
        } else {
            $password = $_POST['password'];
        }
        // Input needs to be validated for correctness, run a api request to check.

        // Assembles base api url, is appended with specific api call in curl_request.php
        // escapes user input in case of malicious inputs
        $_SESSION['url'] = "https://" . htmlspecialchars($key) . ":" . htmlspecialchars($password) . "@"
        . htmlspecialchars($url) . "/admin/api/2021-04/";

        // Redirects to index.php if form is successfully submited
        // META tag is for situations where JS is disabled
        if (!array_filter($errors)) {
            echo "<script type='text/javascript'>document.location.href='index.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . 'index.php' . '">';
        }
    }


?>
<?php include '../Templates/header.php'; ?>
    <!-- Form for input of api data -->
    <section class="container dark-grey-text">
        <h4 class="center">Send request</h4>
        <form class="grey lighten-1" action="request.php" method="POST">
            <label class="grey-text text-darken-4">URL (format: example.myshopify.com):</label>
            <input type="text" name="url" value="<?php echo htmlspecialchars($url); ?>">
            <div class="red-text"><?php echo $errors['url']; ?></div>
            <label class="grey-text text-darken-4">Key:</label>
            <input type="text" name="key" value="<?php echo htmlspecialchars($key); ?>">
            <div class="red-text"><?php echo $errors['key']; ?></div>
            <label class="grey-text text-darken-4">Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="connect" class="btn brand">
            </div>
        </form>
    </section>

<?php include '../Templates/footer.php'; ?>

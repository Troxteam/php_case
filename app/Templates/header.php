<!DOCTYPE html>
<!--Defines html head and website header -->
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>PHP Case</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
        <style type="text/css">
            .brand{
                background: #e3823a !important;
            }
            .brand-text{
                color: #e3823a !important;
            }
            .id-text{
                text-align: left;
            }
            .brand-size{
                max-width: 960px;
                margin: 20px auto;
                padding: 20px;
            }
            form{
                max-width: 960px;
                margin: 20px auto;
                padding: 20px;
            }
            tbody {
                display: block;
                height: 480px;
                overflow: auto;
                max-width: 960px;
                margin: 20px auto;
                padding: 20px;
                text-align: center;
            }
            thead, tbody tr {
                display: table;
                width: 100%;
                table-layout: fixed;
                max-width: 960px;
                margin: 20px auto;
                padding: 20px;
                text-align: center;
            }
            td {
                text-align: center;
            }
            thead {
                width: calc( 100% - 1em );
            }
            table {
                width: 100%;
            }
            </style>
        </head>
        <body class="grey lighten-1">
            <nav class="grey darken-1">
                <div class="container">
                    <a href="index.php" class="brand-logo brand-text">PHP Case</a>
                    <ul id="nav-mobile" class="right hide-on-small-and-down">
                        <?php if (isset($_SESSION['url'])) { ?>
                            <li class="grey-text"><?php echo htmlspecialchars($_SESSION['store'] ?? "Not connected to store"); ?></li>
                        <?php } ?>
                        <li><a href="request.php" class="btn brand">Connect to store</a></li>
                    </ul>
                </div>
            </nav>

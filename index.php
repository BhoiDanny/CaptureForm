<?php session_start(array("name" => "CaptureForm"));?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Daniel Botchway">
    <meta name="description" content="Capture Form">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>FORM | CAPTURE</title>
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: "Montserrat", "Open Sans", sans-serif;
            font-size: 16px;
        }
        body {
            margin: 0;
            padding: 0;
        }
        a {
            text-decoration: none;
            color: tomato;
        }
        a:hover {
            color: crimson;
        }
        h1,h2 {
            font-weight: 500;
            font-size: 1.5em;
        }
        .container {
            max-width: 1200px;
            margin-inline: auto;
            text-align: center;
        }
        .head {
            text-transform: uppercase;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            padding: 20px;
            width: 100%;
            text-align: center;
            text-decoration: none;
            font-weight: 400;
            color: black;
            font-size: 1.1em;
        }
        .footer:hover {
            color: crimson;
        }
        table {
            border-collapse: collapse;
            margin-inline: auto;
        }
        tr, td, th {
            border: 1px solid #0062A2;
            padding: 10px;
        }
        tr th {
            background-color: #0062A2;
            color: white;
            font-weight: 500;
        }
        .button {
            margin-top: 15px;
            padding: 10px 15px;
            border: none;
            background-color: rgba(14, 107, 165, 0.83);
            border-radius: 15px;
        }
        .button a {
            color: white;
        }
        .button:hover {
            background-color: rgba(14, 107, 165, 0.93);
        }
        .by {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="head">Capture your Form</h1>
        <table>
            <thead>
                <tr>
                    <th>Post Names</th>
                    <th>Post Values</th>
                </tr>
            </thead>
            <tbody><?php /*Grab Incoming Data*/
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!empty($_POST)):
            $incoming = array();
            foreach($_POST as $key => $value):
                $key = ucfirst($key);
                if(empty($value)) {
                    $value = "No value returned";
                }
                $incoming[$key] = $value;
                $_SESSION['incoming'] = $incoming;
                $_SESSION['back'] = $_SERVER["HTTP_REFERER"];
            endforeach;
            foreach($_SESSION['incoming'] as $name => $value):
                echo("
            <tr>
                <td>$name</td>
                <td>$value</td>
            </tr>
            ");
            endforeach;
        else:
            echo("
            <tr>
                <td>No Data</td>
                <td>No Data</td>
            </tr>
            ");
        endif;
    } else {
        if(isset($_SESSION['incoming'])):
            $ses = $_SESSION['incoming'];
            foreach($ses as $name => $value):
                echo("
            <tr>
                <td>$name</td>
                <td>$value</td>
            </tr>
            ");
            endforeach;
        else:
            echo("
            <tr>
                <td>No Data</td>
                <td>No Data</td>
            </tr>
            ");
        endif;
    }
        ?></tbody>
        </table>

        <?php /*Clear Data Stored in Session*/
            if(isset($_GET['clear'])) {
                unset($_SESSION['incoming']);
                header("Location: ./");
            }
            if (isset($_SESSION['incoming'])){
                echo('<button class="button"><a href="./?clear">Clear Data</a></button>');
            }
        ?>
        <p class="by">Designed by <a href="https://github.com/BhoiDanny/" target="_blank">Daniel Botchway</a></p>
    </div>
    <footer><?php /*Replace the back link*/
if(!empty($_POST)) {
    if(isset($_SERVER['HTTP_REFERER'])){
        $refer = $_SERVER['HTTP_REFERER'];
        echo("
        <a class=\"footer\" href=\"$refer\">Go Back</a>
        ");
    } else {
        echo("
        <a class=\"footer\" href=\"javascript:history.back()\">Go Back</a>
        ");
    }
} else {
    if(isset($_SESSION['back'])){
        echo("
        <a class=\"footer\" href=\"{$_SESSION['back']}\">Go Back</a>
        ");
    }
}
?></footer>
</body>
</html>
<?php
if(empty($_POST) || !isset($_POST["time"]) || $_POST["time"] > time() - 60)
{
    $json = json_decode(file_get_contents("http://tftv-api.herokuapp.com/api/streams.php"));
    if($json === NULL)
    {
        die("<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <meta http-equiv=\"refresh\" content=\"5;url=index.php\">
        <title>Redirecting...</title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
    </head>
    <body>
        <h1 align=\"center\">Streams cannot be loaded right now, please try again later.</h1>
        <h2 align=\"center\">Redirecting to homepage in 5 seconds...</h2>
    </body>
</html>");
    }
}
else
{
    $json = $_POST;
}

header("Location: " . $json[array_rand($json)]);
?>

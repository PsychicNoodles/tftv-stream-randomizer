<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TFTV Stream Randomizer</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <div id="logo-wrapper">
            <a href="http://teamfortress.tv/">
                <img src="img/tftv-logo.png" alt="tftv logo" />
            </a>
            <h1>Stream Randomizer</h1>
        </div>
        <div class="live-streams">
        <?php
        $json = json_decode(file_get_contents("http://tftv-api.herokuapp.com/api/streams.php"));
        if($json !== NULL)
        {
            echo "<ul id=stream-list>\n";
            foreach($json as $stream)
            {
                echo "\t\t\t<li>\n";
                echo "\t\t\t\t<a href=\"" . $stream -> {"Link"} . "\">";
                echo "\t\t\t\t\t<p>" . $stream -> {"Streamer"} . "</p>\n";
                echo "\t\t\t\t\t<div style=\"background:url('" . $stream -> {"Preview"} . "') no-repeat center center transparent; width:150px; height:84px;\">&nbsp;</div>\n";
                echo "\t\t\t\t</a>";
                echo "\t\t\t</li>\n";
            }
            echo "\t\t</ul>\n";
        }
        else
        {
            echo "<center><h1>Streams cannot be loaded right now, please try again later.</h1></center>";
        }
        ?>
        </div>
        <form action="random.php" method="post">
            <?php
            foreach($json as $stream)
            {
                echo "<input type=\"hidden\" name=\"" . $stream -> {"Streamer"} . "\" value=\"" . $stream -> {"Link"} . "\" />";
            }
            echo "<input type=\"hidden\" name=\"time\" value=\"" . $_SERVER["REQUEST_TIME"] . "\" />";
            ?>
            <input id="randomize-button" type="submit" class="randomize" value="Randomize!" />
        </form>
    </body>
</html>

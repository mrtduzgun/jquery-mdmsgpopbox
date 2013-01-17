<?php

if (isset($_GET["test"]) && $_GET["test"] == "1" && isset($_GET["type"])) {
    sleep(5);
    echo $_GET["type"];
}
else {
    echo "fail";
}
?>

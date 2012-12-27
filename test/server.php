<?php

if (isset($_GET["test"]) && $_GET["test"] == "1") {
    sleep(5);
    echo "success";
}
else {
    echo "fail";
}
?>

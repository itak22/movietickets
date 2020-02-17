<?php

include 'action.php';

$reserveID = $_GET['reserve_id'];
$Movie->deleteReserve($reserveID);

?>
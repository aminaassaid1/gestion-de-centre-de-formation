<?php
$title = $_POST["title"];
$connection = mysqli_connect("localhost", "root", "", "centre_formation");
$result = mysqli_query($connection, "SELECT * FROM formation WHERE sujet Like '%$title%' ");
$data = mysqli_fetch_all($result);
echo json_encode($data);


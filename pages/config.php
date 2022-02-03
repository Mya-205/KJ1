<?php
  const DBHOST = 'localhost';
  const DBUSER = '118795';
  const DBPASS = 'saltaire';
  const DBNAME = '118795';

  $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

  if ($conn->connect_error) {
    die('Could not connect to the database!' . $conn->connect_error);
  }

?>

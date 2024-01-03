<?php

    // get id 
    $id = $_GET['id'];

    // connect to database
    $dbpath = '/home/sb8249/database/movies.db';
    $db = new SQLite3($dbpath);

    // delete value from table
    $sql = "DELETE FROM movies WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $rows_affected = $db->changes();

    // close database 
    $db->close();
    unset($db);

    // redirect them back so they can look at the movies
    header("Location: index.php?delete=success");
    exit();

?>
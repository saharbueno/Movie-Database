<?php

    // grab data from the user
    $title = $_POST['title'];
    $year = $_POST['year'];


    // data validation
    if (!$title || !$year) {
        // send them back to search form 
        header("Location: add_form.php?error=forgot");
        exit();
    } else if (!is_numeric($year) || !preg_match('/^\d+$/', $year) || $year < 0 || $year > 2023) {
        // send them back to search form 
        header("Location: search_form.php?error=notint");
        exit();
    }

    // connect to database
    $dbpath = '/home/sb8249/database/movies.db';
    $db = new SQLite3($dbpath);


    // insert a record into our table
    $sql = "INSERT INTO movies (title, year) VALUES (:title, :year)";
    $statement = $db->prepare($sql);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':year', $year);
    $statement->execute();

    $rows_affected = $db->changes();

    // close database 
    $db->close();
    unset($db);


    // redirect them back so they can add more movies to the database
    header("Location: add_form.php?success=true");
    exit();

?>
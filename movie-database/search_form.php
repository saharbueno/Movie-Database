<!doctype html>
<html>
    <head>
        <title>Movie Database: Search</title>
        <style>
            #navigation {
                display: flex;
                flex-direction: row;
                align-items: center;
                margin-bottom: 10px;
            }

            #navigation a {
                margin: 3px;
                color: purple;
                padding: 2px;
                border-width: 0.5px;
                border-color: black;
                border-style: solid;
                width: 100px;
                height: 40px;
                text-align: center;
                line-height: 40px;
            }

            #navigation a:link { text-decoration: none; }

            #navigation a:visited { text-decoration: none; }

            #navigation a:hover { text-decoration: none; color: #E77CAE}

            #navigation a:active { text-decoration: none; }

            body {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            #error {
                width: auto;
                height: 20px;
                color: black;
                background-color: #D7B5F0;
                text-align: center;
                margin-bottom: 10px;
                padding: 6px;
                border-radius: 25px;
            }
            ul {
                margin-top: 10px;
            }

        </style>
    </head>
    <body>
        <h1>My Movie Database</h1>
        
        <?php
            include('header.php');
        ?>

        <?php
            if ($_GET['error'] == 'forgot') {
        ?>

            <div id="error">You did not provide any input! Please input a year or title</div>

        <?php
            } else if ($_GET['error'] == 'notint') {
        ?>

            <div id="error">Please input a valid year and title</div>
                
        <?php
            }
        ?>

        <form method="POST" action="search_form.php">
            Title: <input type="text" name="title"><br>
            Year: <input type="text" name="year"><br>
            <input type="submit" value="Search">
        </form> 

        <?php

        if (isset($_POST['title']) || isset($_POST['year'])) {
            // grab data from the user
            $title = $_POST['title'];
            $year = $_POST['year'];

            if ($title || $year) {
                if ($year && (!is_numeric($year) || !preg_match('/^\d+$/', $year) || $year < 0 || $year > 2023)) {
                    // send them back to search form 
                    header("Location: search_form.php?error=notint");
                    exit();
                }

                // connect to database
                $dbpath = '/home/sb8249/database/movies.db';
                $db = new SQLite3($dbpath);

                // set up a SQL query to get all movies from the table
                if (!$title && $year) {
                    $sql = "SELECT id, title, year FROM movies WHERE year = :year";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':year', $year);
                } else if ($title && !$year) {
                    $sql = "SELECT id, title, year FROM movies WHERE title LIKE :title";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':title', '%' . $title . '%');
                } else {
                    $sql = "SELECT id, title, year FROM movies WHERE title LIKE :title AND year = :year";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':title', '%' . $title . '%');
                    $statement->bindValue(':year', $year);
                }

                // get results
                $result = $statement->execute();

                // iterate over those movies and generate output
                print '<ul>';
                while ($array = $result->fetchArray()) {
                    print '<li>' . $array['title'] . ' (' . $array['year'] . ')</li>';
                }
                print '</ul>';

                $db->close();
                unset($db);
            } else if ($year == "" && $title == "") {
                // send them back to search form 
                header("Location: search_form.php?error=forgot");
                exit();
            }
        }
    ?>
    </body>
</html>

<!doctype html>
<html>
    <head>
        <title>Movie Database</title>
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

            table {
                width: 500px;
                height: auto;
                border-width: 0.5px;
                border-style: solid;
                border-color: black;
                text-align: center;
                position: absolute;
                top: 200px;
            }
            th {
                border-width: 0.5px;
                border-style: solid;
                border-color: black;
                text-align: center;
                width: 35%;
            }
            td {
                border-width: 0.5px;
                border-style: solid;
                border-color: black;
                text-align: center;
            }
            #success {
                width: auto;
                height: 20px;
                color: black;
                background-color: #D7B5F0;
                text-align: center;
                margin-bottom: 10px;
                padding: 6px;
                border-radius: 25px;
            }
        </style>
    </head>
    <body>
        <h1>My Movie Database</h1>

        <?php
            include('header.php');
            if ($_GET['delete'] == 'success') {
        ?>

        <div id="success">Movie was deleted successfully!</div>

        <!-- grab all movies from the database and display to the user -->
        <?php
            }

            // connect to database
            $dbpath = '/home/sb8249/database/movies.db';
            $db = new SQLite3($dbpath);


            // set up a SQL query to get all movies from the table
            $sql = "SELECT id, title, year FROM movies";
            $statement = $db->prepare($sql);
            $result = $statement->execute();
        

            print '<table>';
                print '<th>Title</th>';
                print '<th>Year</th>';
                print '<th>Options</th>';
            // iterate over those movies and generate output
            while ($array = $result->fetchArray()) {
                print '<tr>';
                print '<td>' . $array['title'] . '</td>' . '<td>' . $array['year'] . '</td>' . '<td>' .'<a href="delete.php?id=' . $array['id'] . '">Delete</a>' . '</td>' .'<br>';
                print '</tr>';
            }
            print '</table>';

            $db->close();
            unset($db);

        ?>

    </body>

</html>
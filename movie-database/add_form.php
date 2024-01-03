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
        ?>

        <?php
            if ($_GET['error'] == 'forgot') {
        ?>

            <div id="error">Please input a year and title</div>

        <?php
            } else if ($_GET['error'] == 'notint') {
        ?>
            <div id="error">Please input a valid year and title</div>
        
        <?php
            }
            if ($_GET['success'] == 'true') {
        ?>

            <div id="success">Movie was added successfully!</div>

        <?php
            }
        ?>

        <form method="POST" action="add_save.php">
            Title: <input type="text" name="title"><br>
            Year: <input type="text" name="year"><br>
            <input type="submit" value="Add Movie">
        </form> 

        <?php
            session_start();

            $temp = $_SESSION['$result_array'];
            print $temp;

            unset($_SESSION['$result_array']);
        ?>
    </body>

</html>
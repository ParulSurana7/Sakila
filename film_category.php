<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $index = 0;
        $con = new mysqli('localhost', 'root', '', 'sakila');
        $result = $con->query("SELECT film.title as Title, film.description as Description, category.name as Category , film.release_year as `Release Year`, language.name as Language, film.rating as Rating, film.special_features as `Special Features`
    FROM `film` 
    left join film_category on film.film_id=film_category.film_id
    left join category on film_category.category_id=category.category_id
    left join language on film.language_id=language.language_id
    WHERE category.category_id=$_GET[id]");
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($row[0]))
            $column_name = array_keys($row[0]);
    ?>

        <div class="container">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <?php
                        foreach ($column_name as $clname) {
                        ?>
                            <th><?= $clname ?></th>
                        <?php
                        }
                        ?>

                    </tr>
                </thead>
                <?php
                foreach ($row as $data) {
                ?>
                    <tr>

                        <td><?= ++$index; ?></td>
                        <?php
                        foreach ($column_name as $clname) {
                        ?>
                            <td><?= $data[$clname] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php  }
                ?>
                <tbody>
                <tfoot>
                    <tr>
                        <th>S.No.</th>
                        <?php
                        foreach ($column_name as $clname) {
                        ?>
                            <th><?= $clname ?></th>

                    <?php
                        }
                    } else {
                        return header("location:index.php");
                    }
                    ?>

                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
</body>

</html>
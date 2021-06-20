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
        $result = $con->query("SELECT film.`title` as Title, concat(actor.first_name,' ', actor.last_name) as `Actor Name`  ,film.film_id
    FROM `film` 
    left join film_actor on film.film_id=film_actor.film_id
    left join actor on film_actor.actor_id=actor.actor_id
    WHERE film.film_id=$_GET[id]");
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
                            if ($clname != 'film_id') {
                        ?>
                                <th><?= $clname ?></th>
                        <?php
                            }
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
                            if ($clname == 'Title') {
                        ?>
                                <td>
                                    <a href="rental.php?id=<?= $data["film_id"] ?>" style="color:inherit;"><?= $data[$clname] ?></a>
                                </td>
                            <?php
                            } else if ($clname == 'film_id') {
                            } else {
                            ?>
                                <td><?= $data[$clname] ?></td>
                        <?php
                            }
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
                            if ($clname != 'film_id') {
                        ?>
                                <th><?= $clname ?></th>
                    <?php
                            }
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
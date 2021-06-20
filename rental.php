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
        $result = $con->query("SELECT  DISTINCT( concat(customer.first_name,' ',customer.last_name)) as `Customer Name`, rental.rental_date as `Rental`,rental.return_date as `Return Date` ,payment.amount as Payment, concat(staff.first_name,' ',staff.last_name ) as `By Staff`,customer.customer_id,staff.staff_id,rental.rental_id
    FROM payment
    left join rental on payment.rental_id=rental.rental_id
    left join inventory on rental.inventory_id=inventory.inventory_id
    left join film on inventory.film_id=film.film_id 
    left join customer on rental.customer_id=customer.customer_id
    left join staff on rental.staff_id= staff.staff_id
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
                            if ($clname != 'rental_id' && $clname != 'customer_id' && $clname != 'staff_id') {
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
                            if ($clname == 'Customer Name') {
                        ?>
                                <td>
                                    <a href="customer.php?id=<?= $data["customer_id"] ?>" style="color:inherit;"><?= $data[$clname] ?></a>
                                </td>
                            <?php
                            } else if ($clname == 'By Staff') {
                            ?>
                                <td>
                                    <a href="staff.php?id=<?= $data["staff_id"] ?>" style="color:inherit;"><?= $data[$clname] ?></a>
                                </td>
                            <?php
                            } else if ($clname == 'rental_id' || $clname == 'customer_id' || $clname == 'staff_id') {
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
                            if ($clname != 'rental_id' && $clname != 'customer_id' && $clname != 'staff_id') {
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
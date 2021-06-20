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
        $result = $con->query("SELECT concat(staff.first_name,'', staff.last_name) as `Name`, staff.email as Email, concat(address.address,' , ',city.city,' , ',country.country) as Address
    FROM `staff` 
    left join address on staff.address_id=address.address_id
    left join city on address.city_id=city.city_id
    left join country on city.country_id=country.country_id
    WHERE staff.staff_id=$_GET[id]");
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($row[0]))
            $keys = array_keys($row[0]);
    ?>

        <div class="container">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <?php
                        foreach ($keys as $coloumn) {
                        ?>
                            <th><?= $coloumn ?></th>
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
                        foreach ($keys as $coloumn) {
                        ?>
                            <td><?= $data[$coloumn] ?></td>
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
                        foreach ($keys as $coloumn) {
                        ?>
                            <th><?= $coloumn ?></th>
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
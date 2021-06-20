<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <table class="table table-bordered table-hover">
            </button>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $index = 0;
            $con = new mysqli('localhost', 'root', '', 'sakila');
            $result = $con->query("SELECT actor_id,CONCAT(`first_name`,' ' ,`last_name`) as Name FROM `actor`");

            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>

                    <td><?= ++$index; ?></td>
                    <td><?= $row["Name"]; ?></td>
                    <td>
                        <a href="list.php?id=<?= $row["actor_id"] ?>" style="color:inherit;">Films</a>

                    </td>
                </tr>
            <?php  }
            ?>
            <tbody>
            <tfoot>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
</body>

</html>
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
        $result = $con->query("SELECT concat(actor.first_name,' ',actor.last_name)as `Actor Name`, film.title as `Film Name`, film.description as Description,category.name as Category,
    film.release_year as `Release Year` , language.name as Language,film.rating as Rating, film.rental_duration as `Rental Duration` ,film.rental_rate as `Rental Rate`,film.special_features as `Special Feature`,film.film_id,category.category_id
   FROM `film_actor`
   left join actor on film_actor.actor_id=actor.actor_id
   left join film on film_actor.film_id=film.film_id
   left join language on film.language_id=language.language_id
   left join film_category on film.film_id=film_category.film_id
   left join category on film_category.category_id=category.category_id
   WHERE film_actor.actor_id=$_GET[id]");
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
                            if ($clname != 'film_id' && $clname != 'category_id') {
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
                            if ($clname == 'Film Name') {
                        ?>
                                <td>
                                    <a href="film_actors.php?id=<?= $data["film_id"] ?>" style="color:inherit;"><?= $data[$clname] ?></a>
                                </td>
                            <?php
                            } else if ($clname == 'Category') {
                            ?>
                                <td>
                                    <a href="film_category.php?id=<?= $data["category_id"] ?>" style="color:inherit;"><?= $data[$clname] ?></a>
                                </td>
                            <?php
                            } else if ($clname == 'film_id' || $clname == 'category_id') {
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
                    <th>S.No.</th>
                    <?php
                    foreach ($column_name as $clname) {
                        if ($clname != 'film_id' && $clname != 'category_id') {
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
<!-- 

SELECT concat(actor.first_name,' ',actor.last_name)as `Actor Name`, film.title as `Film Name`, film.description as Description,
film.release_year as `Release Year` , language.name as Language,film.rating as Rating,film.special_features as `Special Feature`,
category.name as Category
FROM `film_actor`
left join actor on film_actor.actor_id=actor.actor_id
left join film on film_actor.film_id=film.film_id
left join language on film.language_id=language.language_id
left join film_category on film.film_id=film_category.film_id
left join category on film_category.category_id=category.category_id
WHERE film_actor.actor_id=1
 -->

<!--
SELECT DISTINCT( customer.customer_id), customer.store_id, concat(customer.first_name,' ', customer.last_name) as `Customer Name`, customer.email as `Customer Email`, concat(address.address,' , ',city.city ,' , ',country.country) as Address, 
rental.rental_date as `Rental Date`,rental.return_date as `Rental Return`,`create_date`
FROM `customer`
left join address on customer.address_id=address.address_id
left join store on customer.store_id=store.store_id
left join city on address.city_id=city.city_id
left join country on city.country_id=country.country_id
left join inventory on store.store_id=inventory.store_id
left join staff on store.store_id=staff.store_id
left join rental on customer.customer_id=rental.customer_id
WHERE 1
 -->
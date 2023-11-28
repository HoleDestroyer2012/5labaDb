<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work with db</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    include "DbActions.php";

    $conn = new DbActions;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $conn->addUserDb();
    }
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $conn->checkTable();
    }
    ?>

    <form method="post" action="">
        <h1>Добавить покупателя в таблицу customers</h1>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="last_name" class="form-control" id="last_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Адрес</label>
            <input type="text" name="delivery_address" class="form-control" id="delivery_address" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input type="tel" name="phone_number" class="form-control" id="phone_number" required>
        </div>
        <button class="btn btn-primary">Подтвердить</button>
    </form>
    <p>
        <?php if (isset($_COOKIE["add_user_log"]))
            echo ($_COOKIE["add_user_log"]) ?>
        </p>

        <form method="get" action="">
            <h1>Посмотреть таблицу</h1>
            <div class="mb-3">
                <label class="form-label">Название таблицы</label>
                <input type="text" name="table_name" class="form-control" id="table_name" required>
            </div>
            <button class="btn btn-primary">Подтвердить</button>
        </form>
        <?php
        if (isset($_COOKIE["rows"])) {
            echo '<table class="table">
       <thead>
           <tr>';
            foreach (array_keys($_COOKIE["rows"][0]) as $key) {
                echo '<th scope="col">' . $key . '</th>';
            }
            echo '</tr>
       </thead>
       <tbody>';

            foreach ($_COOKIE["rows"] as $row) {
                echo '<tr>';
                foreach ($row as $key => $val) {
                    if ($key == 'id') {
                        echo '<th scope="row">' . $val . '</th>';
                    } else {
                        echo '<td>' . $val . '</td>';
                    }
                }
                echo '</tr>';
            }

            echo '</tbody></table>';
        }
        ?>
</body>

</html>
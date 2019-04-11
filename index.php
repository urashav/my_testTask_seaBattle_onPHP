<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea Fight</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/jquery-3.4.0.min.js"
            integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
            crossorigin="anonymous"></script>
</head>
<body>
<div id="content">
    <?php
    echo "<table>";
    for ($x = 0; $x < 10; $x++) {
        echo "<tr>";
        for ($y = 0; $y < 10; $y++) {
            echo "<td style='border: 1px solid black; width: 24px; height: 24px;'><b>0</b></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>

</div>

<button type="button" class="btn btn-success" id="getField">Создать поле</button>

<script>
    $(document).on("click", "#getField", function () {
        $.ajax({

            type: "POST",
            url: '/src/ajax.php',
            success: function (data) {
                $("#content").empty()
                $('#content').html(data);
                $('#getField').html("Обновить");
            }
        });
        e.preventDefault();
    });
</script>
</body>
</html>
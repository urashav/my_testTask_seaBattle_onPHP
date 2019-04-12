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
    $(document).on("click", "#getField", function (e) {
        $.ajax({

            type: "POST",
            url: '/ajax',
            success: function (data) {
                $('#content').empty()
                $('#content').html(data);
                $('#getField').html("Обновить");
            }
        });
        e.preventDefault();
    });
</script>
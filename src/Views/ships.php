
<?php
echo "<table>";
    for ($x = 0; $x < 10; $x++) {
        echo "<tr>";
        for ($y = 0; $y < 10; $y++) {
            if ($result[$x][$y] == 1) {
                echo "<td style='border: 3px solid red; width: 24px'><b>" . $result[$x][$y] . "</b></td>";
            } elseif ($result[$x][$y] == 2) {
                echo "<td style='border: 1px dashed #cc6100; width: 24px'>" . $result[$x][$y] . "</td>";
            } else {
                echo "<td style='border: 1px dashed #000000; width: 24px'>" . $result[$x][$y] . "</td>";
            }
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>

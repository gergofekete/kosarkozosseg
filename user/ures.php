<?php
if (isset($termekek)) {
    while ($row = mysqli_fetch_assoc($termekek)) {
        $hirdetes_id = $row['termek_id'];
        $hirdeto = mysqli_query($connect, "SELECT lname, fname FROM user WHERE user_id = $row[hirdeto_id]");
        $hirdeto_row = mysqli_fetch_assoc($hirdeto);
        $hirdeto_name = $hirdeto_row['lname'] . ' ' . $hirdeto_row['fname'];
        if ($row['jovahagyva'] == '0' && $row['jelentve'] == '0') { ?>
            <tr data-status="2">
                <td><?php echo $row['termek_id']; ?></td>
                <td><?php echo $row['nev']; ?></td>
                <td><?php echo $hirdeto_name . ', ID: ' . $row['hirdeto_id']; ?></td>
                <td><?php echo $row['feltoltes_date']; ?></td>
                <td><span class="label label-warning">Jóváhagyásra vár</span></td>
                <td><a href="../admin/hirdeteskezeles.php?hirdetesId=<?php echo $hirdetes_id; ?>"><button type="button" class="btn btn-sm manage">Megtekintés</button></a></td>
            </tr>
        <?php
        } else if ($row['jovahagyva'] == '1' && $row['jelentve'] == '0') { ?>
            <tr data-status="1">
                <td><?php echo $row['termek_id']; ?></td>
                <td><?php echo $row['nev']; ?></td>
                <td><?php echo $hirdeto_name . ', ID: ' . $row['hirdeto_id']; ?></td>
                <td><?php echo $row['feltoltes_date']; ?></td>
                <td><span class="label label-success">Jóváhagyva</span></td>
                <td><a href="../admin/hirdeteskezeles.php?hirdetesId=<?php echo $hirdetes_id; ?>"><button type="button" class="btn btn-sm manage">Megtekintés</button></a></td>
            </tr>
        <?php
        } else if ($row['jelentve'] == '1' && ($row['jovahagyva'] == '0' || $row['jovahagyva'] == '1')) { ?>
            <tr data-status="3">
                <td><?php echo $row['termek_id']; ?></td>
                <td><?php echo $row['nev']; ?></td>
                <td><?php echo $hirdeto_name . ', ID: ' . $row['hirdeto_id']; ?></td>
                <td><?php echo $row['feltoltes_date']; ?></td>
                <td><span class="label label-danger">Jelentett</span></td>
                <td><a href="../admin/hirdeteskezeles.php?hirdetesId=<?php echo $hirdetes_id; ?>"><button type="button" class="btn btn-sm manage">Megtekintés</button></a></td>
            </tr>
<?php
        }
    }
}
?>
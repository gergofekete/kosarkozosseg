<?php
include('../session.php');
access("ADMIN");
include('../connect.php');

$termekek = mysqli_query($connect, "SELECT * FROM termekek WHERE torolve = '0' ORDER BY feltoltes_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin felület</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <style>
        @import "../style/navstyle.css";
        @import "../style/adminkezdolap.css";
    </style>
    <script>
        $(document).ready(function() {
            $(".btn-group .btn").click(function() {
                var inputValue = $(this).find("input").val();
                if (inputValue != '0') {
                    var target = $('table tr[data-status="' + inputValue + '"]');
                    $("table tbody tr").not(target).hide();
                    target.fadeIn();
                } else {
                    $("table tbody tr").fadeIn();
                }
            });

            var bs = $.fn.tooltip.Constructor.VERSION;
            var str = bs.split(".");
            if (str[0] == 4) {
                $(".label").each(function() {
                    var classStr = $(this).attr("class");
                    var newClassStr = classStr.replace(/label/g, "badge");
                    $(this).removeAttr("class").addClass(newClassStr);
                });
            }
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../admin/adminkezdolap.php"><b>Admin</b> Felület</a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="">Admin jog elvétele</a></li>
                    <li><a href="">Admin jog adás</a></li>
                    <li><a href="">Üzenetek</a></li>
                    <li><a href="">Profilom</a></li>
                </ul>
                <ul class="nav navbar-form form-inline navbar-right ml-auto">
                    <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
                </ul>
            </div>
    </nav>

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Feladott <b>hirdetések</b></h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-info active">
                            <input type="radio" name="status" value="0" checked="checked"> Mind
                        </label>
                        <label class="btn btn-success">
                            <input type="radio" name="status" value="1"> Jóváhagyott
                        </label>
                        <label class="btn btn-warning">
                            <input type="radio" name="status" value="2"> Jóváhagyásra vár
                        </label>
                        <!-- <label class="btn btn-danger">
                            <input type="radio" name="status" value="3"> Jelentett
                        </label> -->
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Hirdetés ID</th>
                    <th>Termék</th>
                    <th>Hirdető</th>
                    <th>Feladás dátuma</th>
                    <th>Státusz</th>
                </tr>
            </thead>
            <tbody>
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
                        } else if ($row['jelentve'] == '1' &&($row['jovahagyva'] == '0' || $row['jovahagyva'] == '1')) { ?>
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
            </tbody>
        </table>
    </div>
</body>

</html>
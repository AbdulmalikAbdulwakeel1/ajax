<?php 
$connect = mysqli_connect("localhost", "root", "", "project-i") or die(mysqli_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $networkId = $_POST['networkId'];

    $select = mysqli_query($connect, "SELECT * FROM databundle WHERE n_type='$networkId'");
    
    $options = "";
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_array($select)) {
            $type = $row['network'] . " " . $row['size'] . " " . "&#8358" . " " . $row['amount'] . " " . $row['plan_type'] . "," . $row['validity'] . " days validity";
            $options .= "<option value='" . $row['data_id'] . "' data-amount='" . $row['amount'] . "'>" . $type . "</option>";
        }
    }

    echo $options;
}
?>

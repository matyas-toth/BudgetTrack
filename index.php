<?php 

include_once("functions.php");
include_once("BudgetDisplay.php");

$display = new BudgetDisplay("budget");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Budget calculator</title>
</head>
<body>
    
    <h1><a href="?period=<?php echo $display->getRawPreviousPeriod(); ?>">«</a> <?php echo $display->getCurrentPeriod(); ?> <a href="?period=<?php echo $display->getRawNextPeriod(); ?>">»</a></h1>

    <hr>
    <br>

    <table>

        <tr>
            <th>Item</th>
            <th>Date Added</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>

        <?php

            if($display->areThereItems()) {
            
                foreach($display->getItems() as $item ) {

                    echo '
                    
                    <tr>
                    <td>'.$item["name"].'</td>
                    <td>'.getTimeAgo($item["added"]).'</td>
                    <td>'.number_format($item["amount"]).'</td>
                    <td><button>Edit</button><a href="remove.php?period='.$display->getRawCurrentPeriod().'&id='.$item["id"].'"><button>Remove</button></a></td>
                    </tr>

                    ';

                }

            }

        ?>


        <tr class="divider">
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
        </tr>

        <tr class="summary">
            <td>Summary</td>
            <td></td>
            <td><?php echo number_format($display->getSummary()) ?></td>
            <td></td>
        </tr>

        <tr class="divider">
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
        </tr>


        <tr class="add">
            <td><input type="text" id="item" name="item"></td>
            <td></td>
            <td><input type="number" id="amount" name="amount"></td>
            <script>

            function addNew() {

                name = document.getElementById("item").value;
                amount = document.getElementById("amount").value;

                window.location.href = "add.php?period=<?php echo $display->getRawCurrentPeriod(); ?>&name=" + name + "&amount=" + amount;

            }

            </script>
            <td><button onclick="addNew();">Add new</button></td>
        </tr>

    </table>

</body>
</html>
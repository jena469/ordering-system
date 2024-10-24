<?php include('route.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php'); ?>
    <title>Reciept | Page</title>
    <style>
        button.swal2-confirm.btn.btn-success {
            margin: 13px;
        }
        #table_style {
            font-family: Arial, sans-serif;
            padding: 10px;
            max-width: 300px; 
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em; 
        }
        th, td {
            padding: 5px; 
            border: none; 
        }
        th {
            font-weight: normal; /* Non-bold header text */
        }
        .header, .footer {
            padding-bottom: 5px;
            margin-bottom: 5px;
        }
        .centered {
            text-align: center; 
            font-weight: bold; /* Make text bold */
        }
        .footer {
            border-top: 1px solid #000; /* Line separator at the top of footer */
            padding-top: 5px;
            margin-top: 10px;
            font-weight: bold;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mb-5 " id="table_style">
        <div class="card print-content" style="max-width: 700px;margin:auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        Reciept
                    </div>
                    <!-- <div class="col-md-6 text-right">
                        <?= date('Y-m-d');
                        $addressR = '';
                        $payMethod = ''; 
                        $totalamount=0;
                        ?>
                    </div> -->
                </div>
            </div>
            <div class="card-body" >
                
                <table >
                    <thead>
                        <tr class="header">
                            <th colspan="4" class="text-center" style="font-weight: bold; border-bottom: 1px solid #000;" >Bryan Mini Grocery</th>
                        </tr>
                        <tr class="centered">
                            <td colspan="4">Rizal St Brg 8 Poblacion</td>
                        </tr>
                        <tr class="centered">
                            <td colspan="4">Gen. Tinio, N.E.</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="centered">
                            <td colspan="4">ORDER SLIP</td>
                        </tr>
                        <tr>
                            <td colspan="4">Delivery Address: <?= $cartObj->getaddressForReciept($_SESSION['reg_id'])[0]; ?></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="4">S0#: 0000000</td>
                        </tr> -->
                        <tr>
                            <td colspan="4">Date:  <?= date('Y-m-d');
                            $addressR = '';
                            $payMethod = ''; 
                            $totalamount=0;
                            ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>Price</td>
                            <td>Qty</td>
                            <td>Amount</td>
                        </tr>
                        <?php $i = 0;
                            foreach ($_SESSION['getReciept'] as $rows) :
                                $items = $cartObj->getMenuForReciept($rows['menuId']);
                        
                                
                        ?>
                            <tr>
                                <td><?= $items[0] ?></td>
                                <td><?= $items[1] ?></td>
                                <td><?= $rows['qty'] ?></td>
                                <td><?= $items[1] * $rows['qty'] ?></td>
                            </tr>
                        <?php
                            $subtotal = ($items[1] * $rows['qty']);


                            $totalamount+=$subtotal;

                            $i++;
                            endforeach; 
                        ?>
                        
                        
                        <tr style="border-top: 1px solid #000;" >
                            <td  colspan="3" class="total" style="padding-top: 10px">Subtotal</td>
                            <td class="total" style="padding-top: 10px"><?=  $subtotal ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="total">Amount Due</td>
                            <td class="total"><?=  $subtotal ?></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" class="total">Payment Method</td>
                            <?php
                            $paymentMethod = 'Cash On Delivery'; 

                            $displayValue = $cartObj->getaddressForReciept($_SESSION['reg_id'])[1];;
                            ?>

                            <td class="total"><?= $displayValue; ?></td>
                        </tr> -->
                        <tr class="footer" style="font-size: 20px">
                            <td colspan="3" class="total">Total Amount</td>
                            <td class="total"><?= $totalamount ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr style="height: 30px;">
        <td colspan="4"></td>
    </tr>
                        <tr style="margin-top: 50px">
                            <td colspan="4" class="text-center "  style="font-size: 15px"><strong><?php echo isset($_SESSION['customerName']) ? $_SESSION['customerName'] : 'Customer' ?></strong></td>
                        </tr>
                        
                        <tr class="centered footer" >
                        <td colspan="4">Received By</td>
                        </tr>
                    </tfoot>
                    </table>
                <button class="btn btn-primary float-right print-btn">PRINT</button>

            </div>


        </div>

        <script>
            $('.print-btn').on('click', function() {
                // Print .print-content
                $('.print-btn').hide();
                var content = $('.print-content').html();
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print</title>   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"></head><body>');
                printWindow.document.write(content);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
                $('.print-btn').show();
            });
        </script>

        <?php include('footer.php'); ?>
</body>

</html>
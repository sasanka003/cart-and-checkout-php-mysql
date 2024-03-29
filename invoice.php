<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style>
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .status-badge{
    color: white
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
  </style>
</head>
<body>
<?php require "nav/nav.php";?>

<?php

require 'classes/transaction.class.php';
$objTrans = new transaction($conn);
$tId = $_SESSION['tid'];
$objTrans->setId($_SESSION['tid']);
$transaction = $objTrans->getTransaction();

// print_r($transaction);

// Update workshopSeat class instantiation
require 'classes/workshopSeat.class.php';
$objWseat = new workshopSeat($conn);
$objWseat->setTid($tId);
$Wseats = $objWseat->getWorkshopSeatsByTid();

// print_r($Wseats);

?>


<div class="container" style="padding-top: 20px; padding-bottom: 100px;">
    <div class="toolbar hidden-print">
        <div class="card-body text-end">
            <button type="button" class="btn btn-dark" id="printInvoice"><i class="fa fa-print"></i> Print</button>
            <button type="button" class="btn btn-danger" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <!-- <h1 class="text-center">Invoice</h1> -->
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a target="_blank" href="https://lobianijs.com">
                                    <img id="logo" src="images/logo-udemy.png" data-holder-rendered="true" height="120" style="width: auto;" />
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="https://GeniZap.com">
                                        GeniZap
                                        </a>
                                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>GeniZap.services@gmail.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to"><?= $transaction['name']; ?></h2>
                                    <div class="address"><?= $transaction['address']; ?></div>
                                    <div class="email"><a href="mailto:".<?= $transaction['email']; ?>><?= $transaction['email']; ?></a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Invoice #DS0204 </h1>
                                    <h4 class="status-badge"><span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                    <div class="date">Date of Invoice: <?= date('Y-m-d', strtotime($transaction['createdOn'])); ?></div>
                                    <div class="date">Due Date: <?= date('Y-m-d', strtotime($transaction['createdOn'] . ' +1 month')); ?></div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">HOUR PRICE</th>
                                        <th class="text-right">HOURS</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $subTotal   = 0;
                                    $quantity   = 0;
                                    $tax        = 10;
                                      
                                      foreach ($Wseats as $key => $Wseat) { 
                                        $subTotal += $Wseat['price'];
                                        $quantity += $Wseat['quantity'];
                                        ?>
                                        <tr>
                                            <td class="no"><?= $key + 1; ?></td>
                                            <td class="text-left">
                                                <h3><?= $Wseat['title']; ?></h3>
                                                <?= $Wseat['description']; ?>
                                            </td>
                                            <td class="unit">$<?= $Wseat['price']; ?></td>
                                            <td class="qty"><?= $Wseat['quantity']; ?></td>
                                            <td class="total">$<?= $Wseat['price'] * $Wseat['quantity']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>$<?= number_format( $subTotal, 2 ); ?>.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX (+$10)</td>
                                        <td>$<?= number_format( $tax * $quantity, 2 ); ?>.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>$<?= number_format( $subTotal+($tax * $quantity), 2 ); ?>.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div>
                        </main>
                        <footer>
                            Invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="position: fixed; bottom: 10px; right: 10px; color: green;">
    <a href="https://www.instagram.com/your_instagram_username" target="_blank" rel="noopener noreferrer">
        <i class="material-icons" style="vertical-align: middle;">camera_alt</i>
        <strong style="margin-left: 5px;">
            Instagram
        </strong>
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
    $(document).ready(function () {
        $('#printInvoice').click(function () {
            // Use html2canvas to capture the content of the container
            html2canvas($('.invoice')[0], { scale: 2 }).then(function (canvas) {
                var imgData = canvas.toDataURL('image/png');

                // Initialize jsPDF
                var pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                
                // Add the image to the PDF
                pdf.addImage(imgData, 'PNG', 10, 20, 190, 200);
                pdf.setFont('helvetica');
                pdf.setFontSize(12);

                // Save or open the PDF
                pdf.save('invoice.pdf');
            });
        });
    });
</script>



</body>
</html>




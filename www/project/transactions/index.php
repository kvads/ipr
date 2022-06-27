<?php
require_once '../../vendor/autoload.php';

use Transactions\App\Transactions;

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('FILES_PATH', $root . 'transactions/app/upload' . DIRECTORY_SEPARATOR);

$entityTransactions = new Transactions();

$transactions = $entityTransactions->getTransactionsArray(FILES_PATH);
/*echo '<pre>';
var_dump($transactions);
echo '</pre>';*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Check #</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($transactions['TRANS'] as $transaction):?>
    <tr>
        <td><?=$transaction['date']?></td>
        <td><?=$transaction['checkNum']?></td>
        <td><?=$transaction['description']?></td>
        <td><?=$transaction['amount']?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Total Income:</th>
        <td><?=$transactions['TOTALS']['incomeTotal']?></td>
    </tr>
    <tr>
        <th colspan="3">Total Expense:</th>
        <td><?=$transactions['TOTALS']['expenseTotal']?></td>
    </tr>
    <tr>
        <th colspan="3">Net Total:</th>
        <td><?=$transactions['TOTALS']['netTotal']?></td>
    </tr>
    </tfoot>
</table>
</body>
</html>

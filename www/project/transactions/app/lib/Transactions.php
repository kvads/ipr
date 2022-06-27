<?php
declare(strict_types=1);

namespace Transactions\App;

use Throwable;

class Transactions
{
    private array $transactions = [];

    /**
     * @return array
     */
    public function getTransactionsArray(string $dirPath): array
    {
        $files = self::getFiles($dirPath);
        if (is_array($files) && !empty($files)) {
            foreach ($files as $file) {
                self::getTransactions($file);
            }
        } else {
            echo 'No files';
        }

        if (is_array($this->transactions) && !empty($this->transactions)) {
            $this->transactions['TOTALS'] = self::calcTotals($this->transactions['TRANS']);
            return $this->transactions;
        }
    }

    private function getFiles(string $dirPath): array
    {
        $files = [];
        foreach (scandir($dirPath) as $file) {
            if (is_dir($file)) {
                continue;
            } else {
                $files[$file] = $dirPath . $file;
            }
        }
        return $files;
    }

    private function getTransactions(string $fileName)
    {
        $file = fopen($fileName, 'r');
        fgetcsv($file);
        while (($transaction = fgetcsv($file)) !== false) {
            $transaction = self::extractTransaction($transaction);
            $this->transactions['TRANS'][] = $transaction;
        }
    }

    private function extractTransaction(array $transactionRow): array
    {
        [$date, $checkNum, $desc, $amount] = $transactionRow;
        $amount = (float)str_replace(['$', ','], '', $amount);
        return [
            'date' => $date,
            'checkNum' => $checkNum,
            'description' => $desc,
            'amount' => $amount
        ];
    }

    private function calcTotals(array $arTransactions): array
    {
        $totals = ['netTotal' => 0, 'incomeTotal' => 0, 'expenseTotal' => 0];
        foreach ($arTransactions as $transaction) {
            $totals['netTotal'] += $transaction['amount'];

            if ($transaction['amount'] <= 0) {
                $totals['expenseTotal'] += $transaction['amount'];
            } else {
                $totals['incomeTotal'] += $transaction['amount'];
            }
        }
        return $totals;
    }
}
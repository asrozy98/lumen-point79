<?php

namespace App\Helpers;

use App\Models\Transaksi;
use Carbon\Carbon;

class Helpers
{
    public static function poin($id)
    {
        $pulsa = Transaksi::where('account_id', $id)->where('description', 'Beli Pulsa')->get();
        $poinPulsa = 0;
        $rulePulsa1 = 10000;
        $rulePulsa2 = 30000;
        foreach ($pulsa as $i => $item) {
            if ($item->amount >= $rulePulsa1 && $item->amount <= $rulePulsa2) {
                $item->amount -= $rulePulsa1;
                $sisa = $item->amount - ($item->amount % 1000);
                $poin = $sisa / 1000;
                $poinPulsa += $poin;
            } else if ($item->amount > $rulePulsa2) {
                $item->amount -= $rulePulsa2;
                $sisa1 = $item->amount - ($item->amount % 1000);
                $poin1 = ($sisa1 / 1000) * 2;

                $sisa2 = ($rulePulsa2 - $rulePulsa1) - (($rulePulsa2 - $rulePulsa1) % 1000);
                $poin2 = ($sisa2 / 1000);
                $poinPulsa += $poin1 + $poin2;
            };
        }

        $listrik = Transaksi::where('account_id', $id)->where('description', 'Bayar Listrik')->get();

        $poinListrik = 0;
        $ruleListrik1 = 50000;
        $ruleListrik2 = 100000;
        foreach ($listrik as $i => $item) {
            if ($item->amount >= $ruleListrik1 && $item->amount <= $ruleListrik2) {
                $item->amount -= $ruleListrik1;
                $sisa = $item->amount - ($item->amount % 2000);
                $poin = $sisa / 2000;
                $poinListrik += $poin;
            } else if ($item->amount > $ruleListrik2) {
                $item->amount -= $ruleListrik2;
                $sisa1 = $item->amount - ($item->amount % 2000);
                $poin1 = ($sisa1 / 2000) * 2;

                $sisa2 = ($ruleListrik2 - $ruleListrik1) - (($ruleListrik2 - $ruleListrik1) % 2000);
                $poin2 = ($sisa2 / 2000);

                $poinListrik += $poin1 + $poin2;
            };
        }
        $total = $poinPulsa + $poinListrik;
        return $total;
    }

    public static function dateFormat($date)
    {
        $format = Carbon::parse($date)->format('Y-m-d');

        return $format;
    }
}

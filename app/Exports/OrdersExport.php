<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('user')->get();
    }

    public function headings(): array
    {
        return [
            "#", "Role Name", "Crochet", "Cust Name", "Total Price", "Purchase Date"
        ];
    }

    public function map($order): array
    {
        $crochetData = '';
        foreach ($order->crochets as $key => $value) {
            $format = $key+1 . ". " . $value["name_crochet"] . " : " . $value['qyt'] . " (pcs) Rp. " . number_format($value['sub_price'], 0, ',', '.');
            $crochetData .= $format;
        }
        return [
            $order->id,
            $order->user->name,
            $crochetData,
            $order->name_customer,
            "Rp. " . number_format($order->total, 0, ',', '.'),
            \Carbon\Carbon::parse($order->created_at)->format('d F Y'),
        ];
    }
}

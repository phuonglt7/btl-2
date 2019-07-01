<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $pays = Pay::all();
        foreach ($pays as $row) {
            $order[] = array(
                '0' => $row->content,
                '1' => $row->value,
                '2' => $row->wallet_receive,
                '3' => $row->created_at
            );
        }

        return (collect($order));
    }
    public function headings(): array
    {
        return [
            'Nội dung',
            'Số tiền chi',
            'Tài khoản nhận',
            'THời gian'
        ];
    }
}

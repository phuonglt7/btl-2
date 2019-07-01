<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Pay;
use App\Collect;
use App\Wallet;

class CollectExportController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $wallets = Wallet::where('user_id', Auth::id())->first();
        $collet = Collect::where('wallet_id', $wallets->id)->get();
        foreach ($collet as $row) {
            $order[] = array(
                '0' => $row->content,
                '1' => $row->value,
                '2' => $row->created_at
            );
        }

        return (collect($order));
    }

    public function headings(): array
    {
        return [
            'Nội dung',
            'Số tiền thu',
            'Thời gian'
        ];
    }

    public function export()
    {
        return Excel::download(new CollectExportController(), 'Collect.xlsx');
    }
}

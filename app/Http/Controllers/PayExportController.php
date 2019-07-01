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

class PayExportController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $wallets = Wallet::where('user_id', Auth::id())->first();
        $pays = Pay::where('wallet_id', $wallets->id)->get();
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

    public function export()
    {
        return Excel::download(new PayExportController(), 'Pay.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PayRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Wallet;
use App\Pay;
use App\Collect;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('checkExistsWallet');
    }

    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::id())->first();
        $pays = Pay::where('wallet_id', $wallets->id)->orderBy('created_at', 'desc')
                ->paginate(10);
        $count = $pays->count();
        return view('pages.pays.index', compact('pays', 'count'));
    }

    public function create()
    {
        return view('pages.pays.add');
    }

    public function store(PayRequest $request)
    {

        $getWallet = Wallet::where('user_id', Auth::id())->first();
        if ($request->value < $getWallet->coin) {
            $data = $request->all();
            array_shift($data);
            $dataWallet = array_merge($data, ['wallet_id' => $getWallet->id, 'created_at' => new \DateTime()]);
            $pay = Pay::insert($dataWallet);

            //insert values into Wallet
            $leftCoin = $checkWallet->coin - $request->value;
            $wallet = Wallet::where('id', $checkWallet->id)
                            ->update([
                                'coin' => $leftCoin,
                                'updated_at' => new \DateTime()
                            ]);
            if ($pay && $wallet) {
                return redirect(route('pay.index'))->with('status', 'Thêm chi tiêu thành công!');
            } else {
                return redirect()->route()->back()
                            ->with('error', 'Thêm chi tieu không thành công!');
            }
        } else {
            return redirect()->route()->back()
                            ->with('error', 'Số tiền chi ra lớn hơn số tiền trong tài khoản');
        }
    }
}

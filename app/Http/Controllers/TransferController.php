<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransferRequest;
use App\Wallet;
use App\Pay;
use App\Collect;
use App\User;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('checkExistsWallet');
    }

    public function create()
    {
        $wallet = Wallet::where('user_id', '!=', Auth::id())->get();
        return view('pages.transfer', compact('wallet'));
    }

    public function store(TransferRequest $request)
    {
        $checkWallet = Wallet::where('user_id', Auth::id())->first();
        if ($request->value < $checkWallet->coin) {
            $checkWalletName = Wallet::where('wallet_name', $request->wallet_receive)->count();
            if ($checkWalletName > 0 && $checkWallet->wallet_name != $request->wallet_name) {
                //insert values into Pay
                $data = $request->all();
                array_shift($data);
                $dataWallet = array_merge($data, ['wallet_id' => $checkWallet->id, 'created_at' => new \DateTime()]);
                $pay = Pay::insert($dataWallet);

                //insert Collect
                array_pop($data);
                $wallet_collect = Wallet::where('wallet_name', $request->wallet_receive)->first();
                $dataCollect = array_merge($data, ['wallet_id' => $wallet_collect->id,
                    'created_at' => new \DateTime()]);
                $collect = Collect::insert($dataCollect);

                //cập nhật tiền trong ví sau khi gửi
                $leftCoin = $checkWallet->coin - $request->value;
                $wallet = Wallet::where('id', $checkWallet->id)
                            ->update([
                                'coin' => $leftCoin,
                                'updated_at' => new \DateTime()
                            ]);

                //cập nhật tiền trong ví được nhận
                $sumCoin = $wallet_collect->coin + $request->value;
                $wallets_receive = Wallet::where('id', $wallet_collect->id)
                            ->update([
                                'coin' => $sumCoin,
                                'updated_at' => new \DateTime()
                            ]);

                if ($pay && $collect && $wallet && $wallets_receive) {
                    return redirect(route('wallet.index'))->with('status', 'CHuyển tiền thành công!');
                } else {
                        return redirect()->back()->with('status', 'Chuyển tiền không thành công!');
                }
            } else {
                return redirect()->back()
                        ->with('error', 'Tài khoản người nhận không tồn tại!');
            }
        } else {
            return  redirect()->back()
                            ->with('error', 'Tiền trong Ví của bạn nhỏ hơn số tiền chuyển!');
        }
    }
}

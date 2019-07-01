<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Wallet;
use App\Pay;
use App\Collect;
use App\User;
use App\Http\Requests\WalletRequest;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('checkWallet')->only(['create', 'store']);
    }

    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('pages.wallets.index', compact('wallets'));
    }

    public function create()
    {
        return view('pages.wallets.add');
    }

    public function store(WalletRequest $request)
    {
        $wallet =Wallet::insert([
            'user_id' => Auth::id(),
            'wallet_name' => $request->wallet_name,
        ]);
        if ($wallet) {
            return redirect(route('wallet.index'))->with('status', 'Thêm Ví thành công!');
        } else {
            return redirect()->back()->with('status', 'Thêm Ví không thành công!');
        }
    }

    public function edit()
    {
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('pages.wallets.index', compact('wallets'));
    }

    public function update(WalletRequest $request, $id)
    {
        $wallet = Wallet::find($id);
        $wallet = $request::all();
        if ($wallet->save()) {
            return redirect(route('wallet.index'))->with('status', 'Sửa Ví thành công!');
        } else {
            return redirect()->back()->with('status', 'Sửa Ví không thành công!');
        }
    }

    public function destroy($id)
    {
        $pay = Pay::where('wallet_id', $id);
        $countPay = $pay->count();
        $collect = Collect::where('wallet_id', $id);
        $countCollect = $collect->count();
        $wallet = Wallet::where('id', $id);
        if ($wallet->delete()) {
            return redirect(route('wallet.index'))->with('status', 'Xóa ví thành công!');
        } else {
            return redirect(route('wallet.index'))->with('error', 'Không thể xóa Ví!');
        }

        if ($countCollect > 0) {
            if ($collect->delete()) {
                return redirect(route('wallet.index'))->with('status', 'Xóa Thu nhập thành công!');
            } else {
                return redirect(route('wallet.index'))->with('error', 'Không thể xóa Thu nhập!');
            }
        }

        if ($countWallet > 0) {
            if ($wallet->delete()) {
                    return redirect(route('wallet.index'))->with('status', 'Xóa Chi tiêu thành công!');
            } else {
                    return redirect(route('wallet.index'))->with('error', 'Không thể xóa Chi tiêu!');
            }
        }
    }
}

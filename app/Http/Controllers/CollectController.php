<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PayRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Wallet;
use App\Collect;

class CollectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('checkExistsWallet');
    }

    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::id())->first();
        $collects = Collect::where('wallet_id', $wallets->id)->orderBy('created_at', 'desc')
                ->paginate(10);
        $count = $collects->count();
        return view('pages.collects.index', compact('collects', 'count'));
    }

    public function create()
    {
        return view('pages.collects.add');
    }

    public function store(PayRequest $request)
    {
        $getWallet = Wallet::where('user_id', Auth::id())->first();
        $data = $request->all();
        array_shift($data);
        $dataWallet = array_merge($data, ['wallet_id' => $getWallet->id, 'created_at' => new \DateTime()]);
        $collect = Collect::insert($dataWallet);

        //insert values into Wallet
        $sumCoin = $getWallet->coin + $request->value;
        $wallet = Wallet::where('id', $getWallet->id)
            ->update([
                    'coin' => $sumCoin,
                    'updated_at' => new \DateTime()
            ]);
        if ($collect && $wallet) {
            return redirect(route('pay.index'))->with('status', 'Thêm thu nhập thành công!');
        } else {
            return redirect()->route()->back()
                        ->with('error', 'Thêm thu nhập không thành công!');
        }
    }
}

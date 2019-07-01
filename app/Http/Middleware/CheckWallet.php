<?php

namespace App\Http\Middleware;

use Closure;
use App\Wallet;
use Illuminate\Support\Facades\Auth;

class CheckWallet
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $checkWallet = Wallet::where('user_id', Auth::id())->count();
        if ($checkWallet < 1) {
            return $next($request);
        } else {
            return redirect(route('wallet.index'))->with('error', 'Mỗi tài khoản chỉ có một ví');
        }
    }
}

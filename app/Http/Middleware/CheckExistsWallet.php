<?php

namespace App\Http\Middleware;

use Closure;
use App\Wallet;
use Illuminate\Support\Facades\Auth;

class CheckExistsWallet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $checkWallet = Wallet::where('user_id', Auth::id())->count();
        if ($checkWallet > 0) {
            return $next($request);
        } else {
            return redirect(route('wallet.index'))->with('error', 'Bạn phải tạo ví để thực hiện!');
        }
    }
}

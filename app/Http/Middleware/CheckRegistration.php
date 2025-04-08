<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRegistration
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
        // Nếu người dùng đã đăng nhập, chuyển hướng đến dashboard hoặc trang chủ
        if (Auth::check()) {
            return redirect('/dashboard')->with('message', 'Bạn đã đăng nhập!');
        }

        // Nếu không, cho phép tiếp tục xử lý request
        return $next($request);
    }
}

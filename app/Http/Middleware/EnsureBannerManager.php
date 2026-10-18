<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBannerManager
{
    /**
     * 只允許指定帳號管理首頁輪播圖。
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            !$request->user() ||
            $request->user()->email !== 'wei.dev.tw@gmail.com'
        ) {
            abort(403, '你沒有權限管理首頁輪播圖。');
        }

        return $next($request);
    }
}

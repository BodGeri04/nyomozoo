<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockIPAddress
{
    /**
     * @var string[]
     */
    /*public $whiteIps  = [
        '127.0.0.1',
    ];*/
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*$urlcontains1=str_contains(url()->current(), '/admin/home');
        $urlcontains3=str_contains(url()->current(), '/website/advertisement');
        $urlcontains2=str_contains(url()->current(), '/admin/restore/');
        $urlcontains4=str_contains(url()->current(), '/admin/deletedAds');
        $urlcontains5=str_contains(url()->current(), '/website/velemeny');
        $urlcontains6=str_contains(url()->current(), '/admin/emailSend');
        $urlcontains7=str_contains(url()->current(), '/admin/user/status/');
        $urlcontains8=str_contains(url()->current(), '/admin/new_password');
        $urlcontains9=str_contains(url()->current(), '/admin/getIps');
        $urlcontains=$urlcontains1+$urlcontains2+$urlcontains3+$urlcontains4+$urlcontains5+$urlcontains6+$urlcontains7+$urlcontains8+$urlcontains9;
        if ($urlcontains && !in_array($request->getClientIp(), $this->whiteIps)) {
            abort(404);
        }
        return $next($request);*/
    }
}

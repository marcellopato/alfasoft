<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmPassword
{
    protected $auth;
    protected $response;

    public function __construct(Auth $auth, ResponseFactory $response)
    {
        $this->auth = $auth;
        $this->response = $response;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldConfirmPassword($request)) {
            if (! $request->password || ! Hash::check($request->password, $request->user()->password)) {
                return back()
                    ->withErrors(['password' => __('A senha fornecida está incorreta.')]);
            }

            $request->session()->put('auth.password_confirmed_at', time());
            return redirect()->intended('/contacts');
        }

        return $next($request);
    }

    protected function shouldConfirmPassword(Request $request)
    {
        $confirmedAt = time() - $request->session()->get('auth.password_confirmed_at', 0);

        return $confirmedAt > config('auth.password_timeout', 10800);
    }
}
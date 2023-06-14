<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : $request->routeIs('author.*') ? session()->flash('fail', 'You must sign in first') return route('author.login')  ;
        if(!$request->expectsJson()){
            if($request->routeIs('author.*')){
                session()->flash('fail', 'You must sign in first !');
                return route('author.login', ['fail' => true, 'returnUrl' => Url::current() ]);
            }
        }
    }
}

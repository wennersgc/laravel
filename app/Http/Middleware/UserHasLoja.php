<?php

namespace App\Http\Middleware;

use Closure;

class UserHasLoja
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
        if (auth()->user()->loja()->count()) {
            flash('Você já possui uma loja')->warning();
            return redirect()->route('admin.lojas.index');
        }
        return $next($request);
    }
}

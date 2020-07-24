<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class validCategory
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
        if (Category::get()->count() > 0) {
            return $next($request);
        } else {
            session()->flash('error', 'You need An Category to make a post.');
            return redirect()->route('categories.create');
        }
    }
}

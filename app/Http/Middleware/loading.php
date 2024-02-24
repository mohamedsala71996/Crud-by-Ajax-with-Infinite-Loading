<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class loading
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comments = Comment::latest()->paginate(15);
        if ($request->ajax()) {
            $view = view('test.load', compact('comments'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $comments->nextPageUrl()]);
        }

        return $next($request);
    }
}

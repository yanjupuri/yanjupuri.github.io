<?php

namespace App\Http\Middleware;

use App\Models\Visitors;
use Closure;
use Illuminate\Http\Request;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('visitor_tracked')) {
            $visitor = new Visitors();
            
            if ($request->ip() && $request->header('User-Agent')) {
                $visitor->ip_address = $request->ip();
                $browserInfo = $this->parseUserAgent($request->header('User-Agent'));
                $visitor->user_agent = $browserInfo;
                $visitor->save();

                $request->session()->put('visitor_tracked', true);
            }
        }
        return $next($request);
    }

        /**
     * Parse User-Agent header to extract browser information.
     *
     * @param string $userAgent
     * @return array
     */
    private function parseUserAgent($userAgent)
    {
        $browserInfo = null;

        if (strpos($userAgent, 'Chrome') !== false) {
            $browserInfo = 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            $browserInfo = 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            $browserInfo = 'Safari';
        } elseif (strpos($userAgent, 'Opera') !== false) {
            $browserInfo = 'Opera';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            $browserInfo = 'Edge';
        } else {
            $browserInfo = 'Unknown';
        }

        return $browserInfo;
    }
}

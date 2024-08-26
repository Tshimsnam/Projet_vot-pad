<?php

namespace App\Http\Middleware;

use App\Models\IntervenantPhase;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IntervenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd("middleware en place"); 
    
       $phase = session()->get('IdPhase');
       $interv = session()->get('intervenantId');

        $token = IntervenantPhase::select('token')->where('id',$interv)->first();
        // dd($token);
        if($interv!=null && $phase!=null){
            // dd('ikjhhg');
            return $next($request);
        }
        // abort(401);
        return to_route('form-authenticate');
        // dd(session()->get('IdPhase'),
        // session()->get('intervenantId'));
        
    }
}

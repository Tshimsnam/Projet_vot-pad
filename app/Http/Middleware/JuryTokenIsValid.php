<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class JuryTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param Response
     * @param Request $request
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorizationHeader = $request->header('Authorization');
        if (empty($authorizationHeader) || !preg_match('/^Bearer (.+)$/', $authorizationHeader, $matches)) {
            return response()->json(['Erreur' => 'Non autorisé : Token Bearer manquant ou invalide'], 401);
        }

        $token = $matches[1];

        $validToken = DB::table('juries')
            ->where('token', $token)
            ->exists();

        if (!$validToken) {
            return response()->json(['Erreur' => 'Non autorisé : Token de Jury invalide'], 401);
        }
        return $next($request);
    }
}

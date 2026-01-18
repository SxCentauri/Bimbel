<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hasil;
use Symfony\Component\HttpFoundation\Response;

class CekSudahUjian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        $ujian = $request->route('ujian');

        if ($ujian) {
            $hasil = Hasil::where('user_id', Auth::id())
                ->where('ujian_id', $ujian->id)
                ->first();

            if ($hasil && $hasil->selesai) {
                return redirect()->route('tryout.hasil', $ujian->id)
                    ->with('warning', 'Ujian sudah diselesaikan.');
            }
        }

        return $next($request);
    }
}

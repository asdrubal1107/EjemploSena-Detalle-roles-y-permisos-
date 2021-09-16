<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidarPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/login');
        }elseif(request()->ajax()){
            return $next($request);
        }else{
            if(session("permisos") != null){
                $url = $request->getRequestUri();
                foreach(session("permisos") as $permiso){
                    if(strpos($url, $permiso->url) !== false){
                        if($request->isMethod($permiso->metodo)){
                            if($permiso->identico == 1){
                                if($permiso->url == $url){
                                    return $next($request);
                                }
                            }else{
                                return $next($request);
                            }
                        }
                    }
                }
                abort(403, "Usted no tiene permiso para realizar esta acción.");
            }else{
                abort(403, "No tienes permisos registrados.");
            }
        }
    }
}

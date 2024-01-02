<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uses = $request->route()->action['uses'] ?? null;

        $admin = Admin::me();
        if (!Cache::has('permissions')) {
            $permissions = Permission::all();
            Cache::put('permissions', $permissions, 60 * 60 * 24 * 7);
        }
        $permissionName = Cache::get('permissions')->where('method_name', $uses)->first()->name ?? null;
        if (in_array($permissionName, $admin['permissions'])) {
            return $next($request);
        }

        return response()->json([
            'status' => 'error',
            'code' => Response::HTTP_METHOD_NOT_ALLOWED,
            'data' => ['error' => ['İmtiyaz xətası. Sizin ' . $permissionName . ' funksiyasından istifadə hüququnuz yoxdur']]
        ],
            Response::HTTP_METHOD_NOT_ALLOWED
        );
    }
}

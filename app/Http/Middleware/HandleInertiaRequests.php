<?php

namespace App\Http\Middleware;

use App\Models\Configuracion;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'email' => $request->user()->email,
                        'name' => $request->user()->name,
                    ] : null,
                ];
            },

            'web' => [
                'logo' => Config::get('web.logo')
            ],

            'web_data' => Configuracion::getDataWeb(),


            'vehiculos' => Producto::all('id', 'detalle'),
            'servicios' => Servicio::all('id', 'titulo'),


            'flash' => [
                'status' => fn () => $request->session()->get('status'),
                'message' => fn () => $request->session()->get('message'),
                'data' => fn () => $request->session()->get('data')
            ],

        ]);
    }

    public function rootView(Request $request)
    {
        if ($request->routeIs('web.*')) {
            return 'web';
        }
        return 'app';
    }
}

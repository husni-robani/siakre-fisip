<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
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
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => $request->session()->get('flash') ? $request->session()->get('flash') : null,
            'auth' => [
                'user' => $this->getAuthUserData(),
                'roles' => $request->user() ? $request->user()->getRoleNames() : null,
                'permissions' => $request->user() ? $request->user()->getAllPermissions()->pluck('name') : null,
            ],
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    public function getBreadcrumbs(): array
    {
        $segments = \request()->segments();
        $breadcrumbs = [];
        $url = '';
        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumbs[] = [
                'title' => ucwords(str_replace('-', ' ', $segment)),
                'url' => $url
            ];
        }

        return $breadcrumbs;
    }

    public function getAuthUserData()
    {
        return \request()->user()
            ? [
                'id' => \request()->user()->id,
                'name' => \request()->user()->name,
                'email' => \request()->user()->email,
                'major_name' => \request()->user()->major ? \request()->user()->major->name : null,
                'major_id' => \request()->user()->major ? \request()->user()->major_id : null,
            ]
            : null;
    }
}

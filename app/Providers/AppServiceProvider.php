<?php

namespace App\Providers;

use App\Models\OrgMember;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Schema::hasTable('site_infos')) {
                $siteInfo = SiteInfo::first() ?? SiteInfo::defaults();
            } else {
                $siteInfo = SiteInfo::defaults();
            }

            if (Schema::hasTable('org_members')) {
                $orgMembers = OrgMember::orderBy('sort_order')->get();
                if ($orgMembers->isEmpty()) {
                    $orgMembers = OrgMember::defaults();
                }
            } else {
                $orgMembers = OrgMember::defaults();
            }

            $view->with([
                'siteInfo' => $siteInfo,
                'orgMembers' => $orgMembers,
            ]);
        });
    }
}

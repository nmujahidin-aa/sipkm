<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Proposal;
use App\Policies\ProposalPolicy;

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
        // Daftarkan Policy di sini
        $this->registerPolicies();
    }

    /**
     * Register the application's policies.
     */
    protected function registerPolicies(): void
    {
        // Daftarkan Policy untuk Proposal
        $this->app->make(\Illuminate\Contracts\Auth\Access\Gate::class)
            ->policy(Proposal::class, ProposalPolicy::class);
    }

}

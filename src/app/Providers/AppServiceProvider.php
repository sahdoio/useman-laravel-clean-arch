<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // useCases
        $this->app->bind('Core\Domain\UseCases\Authentication\AuthenticationContract', 'Core\Data\UseCases\Authentication\Authentication');

        // repositories
        $this->app->bind('Core\Data\Repositories\User\FindUserRepositoryContract', 'Core\Implementations\Repositories\User\FindUserRepository');
    }
}

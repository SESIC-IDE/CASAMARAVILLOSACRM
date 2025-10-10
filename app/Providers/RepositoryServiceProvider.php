<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    CustomerRepositoryInterface,
    InteractionRepositoryInterface,
    ReminderRepositoryInterface
};
use App\Repositories\Eloquent\{
    CustomerRepository,
    InteractionRepository,
    ReminderRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(InteractionRepositoryInterface::class, InteractionRepository::class);
        $this->app->bind(ReminderRepositoryInterface::class, ReminderRepository::class);
    }

    public function boot(): void {}
}

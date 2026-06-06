<?php

namespace App\Listeners;

use App\Http\Controllers\PermissionController;
use App\Events\AuthenticationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuthenticationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuthenticationEvent $event): void
    {
        PermissionController::loadPermissions($event->data);
    }
}

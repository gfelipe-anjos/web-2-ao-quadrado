<?php

namespace App\Policies;

use App\Models\Matricula;
use App\Models\User;
use App\Http\Controllers\PermissionController;

class MatriculaPolicy
{
     public function viewAny(User $user): bool {
        return PermissionController::isAuthorized('matricula.index');
    }

    public function view(User $user, Matricula $matricula): bool {
        return PermissionController::isAuthorized('matricula.show');
    }

    public function create(User $user): bool {
        return PermissionController::isAuthorized('matricula.create');
    }

    public function update(User $user, Matricula $matricula): bool {
        return PermissionController::isAuthorized('matricula.edit');
    }

    public function delete(User $user, Matricula $matricula): bool {
        return PermissionController::isAuthorized('matricula.delete');
    }

    public function restore(User $user, Matricula $matricula): bool {
        return PermissionController::isAuthorized('matricula.delete');
    }

    public function forceDelete(User $user, Matricula $matricula): bool {
        return PermissionController::isAuthorized('matricula.delete');
    }
}

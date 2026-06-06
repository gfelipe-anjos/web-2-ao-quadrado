<?php

namespace App\Policies;

use App\Models\Disciplina;
use App\Models\User;
use App\Http\Controllers\PermissionController;

class DisciplinaPolicy {
    public function viewAny(User $user): bool {
        return PermissionController::isAuthorized('disciplina.index');
    }

    public function view(User $user, Disciplina $disciplina): bool {
        return PermissionController::isAuthorized('disciplina.show');
    }

    public function create(User $user): bool {
        return PermissionController::isAuthorized('disciplina.create');
    }

    public function update(User $user, Disciplina $disciplina): bool {
        return PermissionController::isAuthorized('disciplina.edit');
    }

    public function delete(User $user, Disciplina $disciplina): bool {
        return PermissionController::isAuthorized('disciplina.delete');
    }

    public function restore(User $user, Disciplina $disciplina): bool {
        return PermissionController::isAuthorized('disciplina.delete');
    }

    public function forceDelete(User $user, Disciplina $disciplina): bool {
        return PermissionController::isAuthorized('disciplina.delete');
    }
}

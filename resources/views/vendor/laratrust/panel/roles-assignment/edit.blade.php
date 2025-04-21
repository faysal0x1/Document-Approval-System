@extends('layouts.admin')

@section('title', 'Permission Management')

@section('content')
<main role="main" class="main">
    @include('vendor.partials.navbar')

    <div class="container-fluid px-4 py-3">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-11">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary bg-gradient text-white py-3">
                        <h4 class="card-title mb-0">User Permissions</h4>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('laratrust.roles-assignment.update', ['roles_assignment' => $user->getKey(), 'model' => $modelKey]) }}">
                            @csrf
                            @method('PUT')

                            <!-- User Info Section -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">User Name</label>
                                <input type="text"
                                    class="form-control bg-light"
                                    name="name"
                                    value="{{ $user->name ?? 'The model doesn\'t have a name attribute' }}"
                                    readonly>
                            </div>

                            <!-- Roles Section -->
                            <div class="card mb-4 border-0 bg-light">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Assigned Roles</h5>
                                    <div class="row g-3">
                                        @foreach ($roles as $role)
                                            <div class="col-md-3 col-sm-4 col-6">
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        class="form-check-input"
                                                        name="roles[]"
                                                        value="{{ $role->getKey() }}"
                                                        {{ $role->assigned ? 'checked' : '' }}
                                                        {{ $role->assigned && !$role->isRemovable ? 'onclick="return false;"' : '' }}>
                                                    <label class="form-check-label {{ $role->assigned && !$role->isRemovable ? 'text-muted' : '' }}">
                                                        {{ $role->display_name ?? $role->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @if ($permissions)
                            <!-- Permissions Section -->
                            <div class="permissions-section">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Permissions</h5>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="selectAllPermissions">
                                        <label class="form-check-label">Select All Permissions</label>
                                    </div>
                                </div>

                                @php
                                    $groupedPermissions = collect($permissions)->groupBy(function ($permission) {
                                        $name = $permission->name;
                                        if (strpos($name, '_') !== false) {
                                            $parts = explode('_', $name);
                                            return $parts[0];
                                        }
                                        preg_match('/^(Create|Edit|Delete|View|Manage)(.+)$/', $name, $matches);
                                        if (!empty($matches)) {
                                            $module = $matches[2];
                                            $module = preg_replace('/(Categories|Category|Reports|Report)$/', '', $module);
                                            return strtolower($module);
                                        }
                                        return 'other';
                                    });

                                    // Split permissions into two groups
                                    $totalModules = $groupedPermissions->count();
                                    $firstHalf = $groupedPermissions->take(ceil($totalModules / 2));
                                    $secondHalf = $groupedPermissions->slice(ceil($totalModules / 2));
                                @endphp

                                <div class="row">
                                    <!-- First Column of Accordions -->
                                    <div class="col-md-6 mb-3">
                                        <div class="accordion" id="permissionsAccordion1">
                                            @foreach ($firstHalf as $moduleKey => $modulePermissions)
                                                <div class="accordion-item border mb-3 rounded-3 shadow-sm">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $loop->index }}">
                                                            <div class="d-flex justify-content-between align-items-center w-100 pe-3">
                                                                <span class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $moduleKey) }}</span>
                                                                <div class="form-check mb-0">
                                                                    <input type="checkbox"
                                                                        class="form-check-input module-select-all"
                                                                        data-module="{{ $moduleKey }}"
                                                                        onclick="event.stopPropagation();">
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="module{{ $loop->index }}" class="accordion-collapse collapse show">
                                                        <div class="accordion-body bg-light">
                                                            <div class="row g-3">
                                                                @foreach ($modulePermissions as $permission)
                                                                    <div class="col-lg-6">
                                                                        <div class="form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input permission-checkbox module-{{ $moduleKey }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission->getKey() }}"
                                                                                {{ $permission->assigned ? 'checked' : '' }}>
                                                                            <label class="form-check-label">
                                                                                {{ $permission->display_name ?? $permission->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Second Column of Accordions -->
                                    <div class="col-md-6 mb-3">
                                        <div class="accordion" id="permissionsAccordion2">
                                            @foreach ($secondHalf as $moduleKey => $modulePermissions)
                                                <div class="accordion-item border mb-3 rounded-3 shadow-sm">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $loop->index + ceil($totalModules / 2) }}">
                                                            <div class="d-flex justify-content-between align-items-center w-100 pe-3">
                                                                <span class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $moduleKey) }}</span>
                                                                <div class="form-check mb-0">
                                                                    <input type="checkbox"
                                                                        class="form-check-input module-select-all"
                                                                        data-module="{{ $moduleKey }}"
                                                                        onclick="event.stopPropagation();">
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="module{{ $loop->index + ceil($totalModules / 2) }}" class="accordion-collapse collapse show">
                                                        <div class="accordion-body bg-light">
                                                            <div class="row g-3">
                                                                @foreach ($modulePermissions as $permission)
                                                                    <div class="col-lg-6">
                                                                        <div class="form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input permission-checkbox module-{{ $moduleKey }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission->getKey() }}"
                                                                                {{ $permission->assigned ? 'checked' : '' }}>
                                                                            <label class="form-check-label">
                                                                                {{ $permission->display_name ?? $permission->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('laratrust.roles-assignment.index', ['model' => $modelKey]) }}"
                                    class="btn btn-danger">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    border-bottom: none;
}
.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,.125);
}
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
.form-check-input:focus {
    box-shadow: none;
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-2px);
}
.permissions-section .accordion-item {
    background-color: #fff;
}
.permissions-section .accordion-button {
    padding: 1rem;
}
.permissions-section .accordion-body {
    padding: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllPermissions = document.getElementById('selectAllPermissions');
    const allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const moduleSelectAlls = document.querySelectorAll('.module-select-all');

    // Main select all functionality
    selectAllPermissions.addEventListener('change', function() {
        allPermissionCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        moduleSelectAlls.forEach(moduleCheckbox => {
            moduleCheckbox.checked = this.checked;
            moduleCheckbox.indeterminate = false;
        });
    });

    // Module select all functionality
    moduleSelectAlls.forEach(moduleCheckbox => {
        moduleCheckbox.addEventListener('change', function(e) {
            e.stopPropagation();
            const moduleKey = this.dataset.module;
            const modulePermissions = document.querySelectorAll(`.module-${moduleKey}`);
            modulePermissions.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateMainCheckbox();
        });
    });

    // Individual permission changes
    allPermissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateModuleCheckbox(this);
            updateMainCheckbox();
        });
    });

    function updateModuleCheckbox(changedCheckbox) {
        moduleSelectAlls.forEach(moduleCheckbox => {
            const moduleKey = moduleCheckbox.dataset.module;
            if (changedCheckbox.classList.contains(`module-${moduleKey}`)) {
                const modulePermissions = document.querySelectorAll(`.module-${moduleKey}`);
                const allChecked = Array.from(modulePermissions).every(checkbox => checkbox.checked);
                const someChecked = Array.from(modulePermissions).some(checkbox => checkbox.checked);

                moduleCheckbox.checked = allChecked;
                moduleCheckbox.indeterminate = someChecked && !allChecked;
            }
        });
    }

    function updateMainCheckbox() {
        const allChecked = Array.from(allPermissionCheckboxes).every(checkbox => checkbox.checked);
        const someChecked = Array.from(allPermissionCheckboxes).some(checkbox => checkbox.checked);

        selectAllPermissions.checked = allChecked;
        selectAllPermissions.indeterminate = someChecked && !allChecked;
    }

    // Initial state setup
    allPermissionCheckboxes.forEach(checkbox => {
        updateModuleCheckbox(checkbox);
    });
    updateMainCheckbox();
});
</script>
@endsection

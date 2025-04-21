@extends('layouts.admin')
@section('title', $model ? "Edit {$type}" : "New {$type}")

@section('content')

	<main id="content" role="main" class="main pointer-event">
		@include('vendor.partials.navbar')

		<div class="container-fluid px-4 py-3">
			<form x-data="laratrustForm()"
			      x-init="{!! $model ? '' : '$watch(\'displayName\', value => onChangeDisplayName(value))' !!}"
			      method="POST"
			      action="{{ $model ? route("laratrust.{$type}s.update", $model->getKey()) : route("laratrust.{$type}s.store") }}"
			      class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-8">
				@csrf
				@if ($model)
					@method('PUT')
				@endif
				<div class="mb-4">
					<label class="form-label fw-semibold">Name/Code</label>
					<input type="text" class="form-control bg-light text-muted" name="name"
					       placeholder="this-will-be-the-code-name"
					       :value="name" readonly>
				</div>

				<div class="mb-4">
					<label class="form-label fw-semibold">Display Name</label>
					<input type="text" class="form-control" name="display_name" placeholder="Edit user profile"
					       x-model="displayName" autocomplete="off">
				</div>

				<div class="mb-4">
					<label class="form-label fw-semibold">Description</label>
					<textarea class="form-control" rows="3" name="description"
					          placeholder="Some description for the {{ $type }}">{{ $model->description ?? old('description') }}</textarea>
				</div>

				@if ($type === 'role')
					<div class="mb-4">
						<h5 class="mb-3">Permissions</h5>
						<div class="form-check mb-3">
							<input type="checkbox" class="form-check-input" id="selectAllPermissions">
							<label class="form-check-label" for="selectAllPermissions">Select All Permissions</label>
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
						@endphp

						<div class="accordion" id="permissionsAccordion">
							@foreach ($groupedPermissions as $moduleKey => $modulePermissions)
								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button" type="button" data-bs-toggle="collapse"
										        data-bs-target="#module{{ $loop->index }}">
											<div class="d-flex justify-content-between align-items-center w-100">
												<span class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $moduleKey) }}</span>
												<div class="form-check mb-0">
													<input type="checkbox" class="form-check-input module-select-all"
													       data-module="{{ $moduleKey }}"
													       onclick="event.stopPropagation();">
												</div>
											</div>
										</button>
									</h2>
									<div id="module{{ $loop->index }}" class="accordion-collapse collapse show">
										<div class="accordion-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="row g-3">
														@foreach ($modulePermissions->slice(0, ceil($modulePermissions->count() / 2)) as $permission)
															<div class="col-12">
																<div class="form-check">
																	<input type="checkbox"
																	       class="form-check-input permission-checkbox module-{{ $moduleKey }}"
																	       name="permissions[]"
																	       value="{{ $permission->getKey() }}" {!! $permission->assigned ? 'checked' : '' !!}>
																	<label class="form-check-label">
																		{{ $permission->display_name ?? $permission->name }}
																	</label>
																</div>
															</div>
														@endforeach
													</div>
												</div>
												<div class="col-lg-6">
													<div class="row g-3">
														@foreach ($modulePermissions->slice(ceil($modulePermissions->count() / 2)) as $permission)
															<div class="col-12">
																<div class="form-check">
																	<input type="checkbox"
																	       class="form-check-input permission-checkbox module-{{ $moduleKey }}"
																	       name="permissions[]"
																	       value="{{ $permission->getKey() }}" {!! $permission->assigned ? 'checked' : '' !!}>
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
									</div>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				<div class="d-flex justify-content-end mt-4">
					<a href="{{ route("laratrust.{$type}s.index") }}" class="btn btn-danger me-2">Cancel</a>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>

		<script>
            function laratrustForm() {
                return {
                    displayName: '',
                    name: '',

                    // Convert display name to code/slug format
                    onChangeDisplayName(value) {
                        this.name = value
                            .toLowerCase()
                            .replace(/[^\w\s-]/g, '') // Remove special characters
                            .replace(/\s+/g, '-') // Replace spaces with hyphens
                            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                            .trim(); // Remove trailing spaces
                    },

                    init() {
                        // If editing an existing model, initialize displayName from the input
                        const displayNameInput = document.querySelector('input[name="display_name"]');
                        if (displayNameInput) {
                            this.displayName = displayNameInput.value;
                        }

                        // If editing, initialize name from the readonly input
                        const nameInput = document.querySelector('input[name="name"]');
                        if (nameInput) {
                            this.name = nameInput.value;
                        }
                    }
                };
            }

            document.addEventListener('DOMContentLoaded', function () {


                const selectAllPermissions = document.getElementById('selectAllPermissions');
                const allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');
                const moduleSelectAlls = document.querySelectorAll('.module-select-all');

                selectAllPermissions.addEventListener('change', function () {
                    allPermissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    moduleSelectAlls.forEach(moduleCheckbox => {
                        moduleCheckbox.checked = this.checked;
                        moduleCheckbox.indeterminate = false;
                    });
                });

                moduleSelectAlls.forEach(moduleCheckbox => {
                    moduleCheckbox.addEventListener('change', function (e) {
                        e.stopPropagation();
                        const moduleKey = this.dataset.module;
                        const modulePermissions = document.querySelectorAll(`.module-${moduleKey}`);
                        modulePermissions.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                        updateMainCheckbox();
                    });
                });

                allPermissionCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
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

                allPermissionCheckboxes.forEach(checkbox => {
                    updateModuleCheckbox(checkbox);
                });
                updateMainCheckbox();
            });
		</script>
	</main>
@endsection

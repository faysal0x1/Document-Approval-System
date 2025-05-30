@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Add New Step to :workflow', ['workflow' => $workflow->name]) }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route($role.'workflows.steps.store', $workflow) }}">
							@csrf

							<div class="form-group row">
								<label for="step_number" class="col-md-4 col-form-label text-md-right">{{ __('Step Number') }}</label>

								<div class="col-md-6">
									<input id="step_number" type="number" min="1" class="form-control @error('step_number') is-invalid @enderror" name="step_number" value="{{ old('step_number', $workflow->steps()->max('step_number') + 1) }}" required>

									@error('step_number')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Step Name') }}</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

									@error('name')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="approver_type" class="col-md-4 col-form-label text-md-right">{{ __('Approver Type') }}</label>

								<div class="col-md-6">
									<select id="approver_type" class="form-control @error('approver_type') is-invalid @enderror" name="approver_type" required>
										<option value="role" {{ old('approver_type') == 'role' ? 'selected' : '' }}>{{ __('Role') }}</option>
										<option value="department" {{ old('approver_type') == 'department' ? 'selected' : '' }}>{{ __('Department') }}</option>
										<option value="user" {{ old('approver_type') == 'user' ? 'selected' : '' }}>{{ __('Specific User') }}</option>
									</select>

									@error('approver_type')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="approver_value" class="col-md-4 col-form-label text-md-right">{{ __('Approver Value') }}</label>

								<div class="col-md-6">
									<input id="approver_value" type="text" class="form-control @error('approver_value') is-invalid @enderror" name="approver_value" value="{{ old('approver_value') }}" required>
									<small class="form-text text-muted">
										{{ __('For Role: role ID, For Department: department ID, For User: user ID') }}
									</small>

									@error('approver_value')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

								<div class="col-md-6">
									<textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

									@error('description')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Save Step') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
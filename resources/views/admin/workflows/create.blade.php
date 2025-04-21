<!-- resources/views/admin/workflows/create.blade.php -->
@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Create New Workflow') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('admin.workflows.store') }}">
							@csrf

							<div class="form-group row">
								<label for="document_type" class="col-md-4 col-form-label text-md-right">{{ __('Document Type') }}</label>

								<div class="col-md-6">
									<input id="document_type" type="text" class="form-control @error('document_type') is-invalid @enderror" name="document_type" value="{{ old('document_type') }}" required autocomplete="off">

									@error('document_type')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Workflow Name') }}</label>

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

							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
										<label class="form-check-label" for="is_active">
											{{ __('Active') }}
										</label>
									</div>
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Save Workflow') }}
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
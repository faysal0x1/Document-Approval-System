@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Create ' . ucfirst(str_replace('_', ' ', $documentType))) }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="document_type" value="{{ $documentType }}">

							@include('documents.forms.' . $documentType)

							<div class="form-group row">
								<label for="attachments" class="col-md-4 col-form-label text-md-right">{{ __('Attachments') }}</label>

								<div class="col-md-6">
									<input id="attachments" type="file" class="form-control-file @error('attachments') is-invalid @enderror" name="attachments[]" multiple>

									@error('attachments')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Submit Document') }}
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
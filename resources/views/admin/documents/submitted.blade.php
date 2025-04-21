<!-- resources/views/documents/submitted.blade.php -->
@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Document Submitted') }}</div>

					<div class="card-body">
						<div class="alert alert-success">
							{{ __('Your :type has been submitted successfully!', ['type' => ucfirst(str_replace('_', ' ', $document->type))]) }}
						</div>

						<div class="mb-4">
							<h5>{{ __('Document Details') }}</h5>
							<p><strong>{{ __('Reference') }}:</strong> #{{ $document->id }}</p>
							<p><strong>{{ __('Submitted on') }}:</strong> {{ $document->created_at->format('m/d/Y H:i') }}</p>
							<p><strong>{{ __('Current Status') }}:</strong>
								<span class="badge badge-primary">{{ ucfirst($document->status) }}</span>
							</p>
						</div>

						<div class="mb-4">
							<h5>{{ __('Next Steps') }}</h5>
							<p>{{ __('Your document is now waiting for approval. You will be notified when it is processed.') }}</p>
						</div>

						<a href="{{ route('documents.index') }}" class="btn btn-primary">
							{{ __('View All Documents') }}
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
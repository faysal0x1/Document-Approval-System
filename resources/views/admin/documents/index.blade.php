@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<span>{{ __('My Documents') }}</span>
						<a href="{{ route('documents.create') }}" class="btn btn-sm btn-primary">{{ __('New Document') }}</a>
					</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<table class="table table-bordered">
							<thead>
							<tr>
								<th>{{ __('Reference') }}</th>
								<th>{{ __('Type') }}</th>
								<th>{{ __('Submitted') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Current Step') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
							</thead>
							<tbody>
							@foreach($documents as $document)
								<tr>
									<td>#{{ $document->id }}</td>
									<td>{{ ucfirst(str_replace('_', ' ', $document->type)) }}</td>
									<td>{{ $document->created_at->format('m/d/Y H:i') }}</td>
									<td>
                                    <span class="badge badge-{{ $document->status === 'approved' ? 'success' : ($document->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($document->status) }}
                                    </span>
									</td>
									<td>
										@if($document->currentApproval)
											{{ $document->currentApproval->workflowStep->name }}
										@else
											{{ __('Completed') }}
										@endif
									</td>
									<td>
										<a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-info">{{ __('View') }}</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>

						{{ $documents->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
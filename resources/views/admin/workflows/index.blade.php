@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<span>{{ __('Workflow Management') }}</span>
						<a href="{{ route($role.'workflows.create') }}" class="btn btn-sm btn-primary">{{ __
						('Create Workflow') }}</a>
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
								<th>{{ __('Document Type') }}</th>
								<th>{{ __('Name') }}</th>
								<th>{{ __('Steps') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
							</thead>
							<tbody>
							@foreach($workflows as $workflow)
								<tr>
									<td>{{ $workflow->document_type }}</td>
									<td>{{ $workflow->name }}</td>
									<td>{{ $workflow->steps_count }}</td>
									<td>
                                    <span class="badge badge-{{ $workflow->is_active ? 'success' : 'danger' }}">
                                        {{ $workflow->is_active ? __('Active') : __('Inactive') }}
                                    </span>
									</td>
									<td>
										<a href="{{ route($role.'workflows.edit', $workflow) }}"
										   class="btn btn-sm btn-info">{{ __('Edit') }}</a>
										<a href="{{ route($role.'workflows.steps.index', $workflow) }}"
										   class="btn btn-sm btn-secondary">{{ __('Steps') }}</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
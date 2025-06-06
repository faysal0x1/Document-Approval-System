@extends('layouts.admin')
@section('title', 'Document Details')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex justify-content-between align-items-center">
						<h6 class="m-0 font-weight-bold text-primary">
							Document #{{ $document->id }} - {{ ucfirst(str_replace('_', ' ', $document->type)) }}
						</h6>
						<span class="badge badge-{{ $document->status === 'approved' ? 'success' : ($document->status === 'rejected' ? 'danger' : 'warning') }}">
                        {{ strtoupper($document->status) }}
                    </span>
					</div>
					<div class="card-body">
						<div class="row mb-4">
							<div class="col-md-6">
								<h5 class="font-weight-bold">Document Information</h5>
								<div class="table-responsive">
									<table class="table table-bordered">
										<tr>
											<th width="30%">Submitted By</th>
											<td>{{ $document->submitter->name }}</td>
										</tr>
										<tr>
											<th>Submission Date</th>
											<td>{{ $document->created_at}}</td>
										</tr>
										<tr>
											<th>Current Status</th>
											<td>
                                            <span class="badge badge-{{ $document->status === 'approved' ? 'success' : ($document->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ strtoupper($document->status) }}
                                            </span>
											</td>
										</tr>
										<tr>
											<th>Document Type</th>
											<td>{{ ucfirst(str_replace('_', ' ', $document->type)) }}</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-md-6">
								<h5 class="font-weight-bold">Document Content</h5>
								<div class="card">
									<div class="card-body">
										@include('admin.documents.partials.content_'.$document->type, ['content' =>
										$document->content])
									</div>
								</div>
							</div>
						</div>

						@if($document->attachments->count() > 0)
							<div class="mb-4">
								<h5 class="font-weight-bold">Attachments</h5>
								<div class="row">
									@foreach($document->attachments as $attachment)
										<div class="col-md-4 mb-3">
											<div class="card">
												<div class="card-body text-center">
													@if(strpos($attachment->mime_type, 'image') === 0)
														<img src="{{ Storage::url($attachment->path) }}"
														     class="img-fluid mb-2" style="max-height: 100px;">
													@else
														<i class="fas fa-file-alt fa-3x mb-2 text-primary"></i>
													@endif
													<p class="mb-1 text-truncate">{{ $attachment->original_name }}</p>
													<a href="{{ Storage::url($attachment->path) }}" target="_blank"
													   class="btn btn-sm btn-primary">
														<i class="fas fa-download"></i> Download
													</a>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Approval History</h6>
					</div>
					<div class="card-body">
						<div class="timeline">
							@foreach($document->approvals as $approval)
								<div class="timeline-item {{ $approval->status === 'rejected' ? 'timeline-item-danger' : ($approval->status === 'approved' ? 'timeline-item-success' : 'timeline-item-pending') }}">
									<div class="timeline-item-marker">
										@if($approval->status === 'approved')
											<i class="fas fa-check-circle"></i>
										@elseif($approval->status === 'rejected')
											<i class="fas fa-times-circle"></i>
										@else
											<i class="fas fa-clock"></i>
										@endif
									</div>
									<div class="timeline-item-content">
										<div class="d-flex justify-content-between">
											<h6 class="font-weight-bold mb-1">{{ $approval->workflowStep->name }}</h6>
											<small class="text-muted">{{ $approval->created_at }}</small>
										</div>
										<p class="mb-1">
											<strong>Approver:</strong> {{ $approval->approver->name }}
											@if($approval->status !== 'pending')
												- {{ $approval->approved_at}}
											@endif
										</p>
										@if($approval->comments)
											<div class="alert alert-light p-2 mb-0">
												<strong>Comments:</strong> {{ $approval->comments }}
											</div>
										@endif
									</div>
								</div>
							@endforeach

							@if($document->status === 'approved')
								<div class="timeline-item timeline-item-completed">
									<div class="timeline-item-marker">
										<i class="fas fa-flag-checkered"></i>
									</div>
									<div class="timeline-item-content">
										<h6 class="font-weight-bold mb-1">Process Completed</h6>
										<p class="mb-0 text-muted">Document fully approved</p>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('style')
	<style>
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }
        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
            padding-left: 2rem;
            border-left: 1px solid #e3e6f0;
        }
        .timeline-item:last-child {
            border-left: 0;
        }
        .timeline-item-marker {
            position: absolute;
            left: -0.5rem;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            text-align: center;
            line-height: 1.5rem;
            background: #fff;
            border: 3px solid;
        }
        .timeline-item-success .timeline-item-marker {
            color: #1cc88a;
            border-color: #1cc88a;
        }
        .timeline-item-danger .timeline-item-marker {
            color: #e74a3b;
            border-color: #e74a3b;
        }
        .timeline-item-pending .timeline-item-marker {
            color: #f6c23e;
            border-color: #f6c23e;
        }
        .timeline-item-completed .timeline-item-marker {
            color: #4e73df;
            border-color: #4e73df;
        }
        .timeline-item-content {
            padding-bottom: 1rem;
        }
	</style>
@endsection
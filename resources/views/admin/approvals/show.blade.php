@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<span>{{ __('Approval Request') }}: {{ ucfirst(str_replace('_', ' ', $approval->document->type)) }}</span>
						<span class="badge badge-{{ $approval->status === 'approved' ? 'success' : ($approval->status === 'rejected' ? 'danger' : 'warning') }}">
                        {{ strtoupper($approval->status) }}
                    </span>
					</div>

					<div class="card-body">
						<div class="row mb-4">
							<div class="col-md-6">
								<h5>{{ __('Document Information') }}</h5>
								<p><strong>{{ __('Submitted by') }}:</strong> {{ $approval->document->submitter->name }}
								</p>
								<p><strong>{{ __('Submitted on') }}
										:</strong> {{ $approval->document->created_at->format('m/d/Y H:i') }}</p>
								<p><strong>{{ __('Current Step') }}:</strong> {{ $approval->workflowStep->name }}
									({{ __('Step :number', ['number' => $approval->workflowStep->step_number]) }})</p>
							</div>
							<div class="col-md-6">
								<h5>{{ __('Approval Information') }}</h5>
								<p><strong>{{ __('Approver') }}:</strong> {{ $approval->approver->name }}</p>
								<p><strong>{{ __('Requested on') }}
										:</strong> {{ $approval->created_at->format('m/d/Y H:i') }}</p>
								@if($approval->status !== 'pending')
									<p><strong>{{ __('Decision') }}:</strong> {{ ucfirst($approval->status) }}</p>
									<p><strong>{{ __('Decision Date') }}
											:</strong> {{ $approval->approved_at->format('m/d/Y H:i') }}</p>
								@endif
							</div>
						</div>

						<div class="card mb-4">
							<div class="card-header bg-light">{{ __('Document Content') }}</div>
							<div class="card-body">
{{--								@include('admin.documents.partials.content_' . $approval->document->type, ['content' =>--}}
{{--								$approval->document->content])--}}
							</div>
						</div>

						@if($approval->document->attachments->count() > 0)
							<div class="mb-4">
								<h5>{{ __('Attachments') }}</h5>
								<div class="list-group">
									@foreach($approval->document->attachments as $attachment)
										<a href="{{ Storage::url($attachment->path) }}" target="_blank"
										   class="list-group-item list-group-item-action">
											<i class="fas fa-file-{{ strpos($attachment->mime_type, 'image') === 0 ? 'image' : (strpos($attachment->mime_type, 'pdf') !== false ? 'pdf' : 'alt') }} mr-2"></i>
											{{ $attachment->original_name }}
										</a>
									@endforeach
								</div>
							</div>
						@endif

						@if($approval->status === 'pending' && auth()->id() === $approval->approver_id)
							<hr>
							<h5 class="mb-3">{{ __('Take Action') }}</h5>

							<form method="POST" action="{{ route('approvals.approve', $approval) }}" class="mb-3">
								@csrf
								<div class="form-group">
									<label for="approve-comments">{{ __('Comments') }} ({{ __('Optional') }})</label>
									<textarea class="form-control" id="approve-comments" name="comments"
									          rows="2"></textarea>
								</div>
								<button type="submit" class="btn btn-success">
									<i class="fas fa-check mr-1"></i> {{ __('Approve') }}
								</button>
							</form>

							<form method="POST" action="{{ route('approvals.reject', $approval) }}">
								@csrf
								<div class="form-group">
									<label for="reject-comments">{{ __('Rejection Reason') }} ({{ __('Required') }}
									                                                          )</label>
									<textarea class="form-control" id="reject-comments" name="comments" rows="2"
									          required></textarea>
								</div>
								<button type="submit" class="btn btn-danger">
									<i class="fas fa-times mr-1"></i> {{ __('Reject') }}
								</button>
							</form>
						@elseif($approval->status !== 'pending')
							<div class="alert alert-{{ $approval->status === 'approved' ? 'success' : 'danger' }}">
								<h5>{{ __('Decision') }}: {{ ucfirst($approval->status) }}</h5>
								<p><strong>{{ __('By') }}:</strong> {{ $approval->approver->name }}</p>
								<p><strong>{{ __('On') }}:</strong> {{ $approval->approved_at->format('m/d/Y H:i') }}
								</p>
								@if($approval->comments)
									<p><strong>{{ __('Comments') }}:</strong> {{ $approval->comments }}</p>
								@endif
							</div>
						@endif

						<hr>
						<h5>{{ __('Approval History') }}</h5>
						<div class="list-group">
							@foreach($approval->document->approvals->sortBy('workflowStep.step_number') as $docApproval)
								<div class="list-group-item {{ $docApproval->id === $approval->id ? 'active' : '' }}">
									<div class="d-flex w-100 justify-content-between">
										<h6 class="mb-1">{{ __('Step :number', ['number' => $docApproval->workflowStep->step_number]) }}
											: {{ $docApproval->workflowStep->name }}</h6>
										<span class="badge badge-{{ $docApproval->status === 'approved' ? 'success' : ($docApproval->status === 'rejected' ? 'danger' : 'secondary') }}">
                                    {{ strtoupper($docApproval->status) }}
                                </span>
									</div>
									<p class="mb-1">
										<strong>{{ __('Approver') }}:</strong> {{ $docApproval->approver->name }}
										@if($docApproval->status !== 'pending')
											- {{ $docApproval->approved_at->format('m/d/Y H:i') }}
										@endif
									</p>
									@if($docApproval->comments)
										<small>{{ __('Comments') }}: {{ $docApproval->comments }}</small>
									@endif
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
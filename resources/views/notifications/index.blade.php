@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')
	<div class="page-content">
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Notifications</div>
			<div class="ps-3 ms-auto">
				@if($notifications->where('read_at', null)->count() > 0)
					<a href="{{ route('notifications.mark-all-read') }}"
					   class="btn btn-sm btn-primary"
					   onclick="event.preventDefault(); document.getElementById('mark-all-read-form').submit();">
						Mark all as read
					</a>
					<form id="mark-all-read-form" action="{{ route('notifications.mark-all-read') }}" method="POST" class="d-none">
						@csrf
					</form>
				@endif
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="notification-filters mb-4">
					<div class="btn-group" role="group">
						<a href="{{ route('notifications.index') }}" class="btn btn-outline-primary {{ $filter == null ? 'active' : '' }}">All</a>
						<a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="btn btn-outline-primary {{ $filter == 'unread' ? 'active' : '' }}">Unread</a>
						<a href="{{ route('notifications.index', ['filter' => 'read']) }}" class="btn btn-outline-primary {{ $filter == 'read' ? 'active' : '' }}">Read</a>
					</div>

				</div>

				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<div class="table-responsive">
					<table class="table align-middle mb-0">
						<thead class="table-light">
						<tr>
							<th>Type</th>
							<th>Details</th>
							<th>Date</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@forelse($notifications as $notification)
							@php
								$documentType = $notification->data['document_type'] ?? 'document';
								$approvalId = $notification->data['approval_id'] ?? null;
								$message = $notification->data['message'] ?? 'Notification';

								// Set icon and style based on document type
								$iconClass = 'fas fa-file';
								$bgClass = 'bg-light-primary';
								$textClass = 'text-primary';

								switch($documentType) {
									case 'leave_application':
										$iconClass = 'fas fa-calendar-minus';
										$bgClass = 'bg-light-info';
										$textClass = 'text-info';
										$typeName = 'Leave Application';
										break;
									case 'expense_claim':
										$iconClass = 'fas fa-receipt';
										$bgClass = 'bg-light-warning';
										$textClass = 'text-warning';
										$typeName = 'Expense Claim';
										break;
									case 'purchase_request':
										$iconClass = 'fas fa-shopping-cart';
										$bgClass = 'bg-light-danger';
										$textClass = 'text-danger';
										$typeName = 'Purchase Request';
										break;
									default:
										$typeName = 'Document Approval';
								}
							@endphp
							<tr class="{{ $notification->read_at ? '' : 'table-light fw-bold' }}">
								<td>
									<div class="d-flex align-items-center">
										<div class="notification-icon {{ $bgClass }} {{ $textClass }} rounded-circle p-2">
											<i class="{{ $iconClass }}"></i>
										</div>
										<span class="ms-2">{{ $typeName }}</span>
									</div>
								</td>
								<td>
									<div>{{ $message }}</div>
									<div class="text-muted small">
										Document Type: {{ str_replace('_', ' ', ucfirst($documentType)) }}
										@if($approvalId)
										| Approval ID: {{ $approvalId }}
										@endif
									</div>
								</td>
								<td>
									<div>{{ Carbon\Carbon::parse($notification->created_at)->format('M d, Y') }}</div>
									<div class="text-muted small">{{ Carbon\Carbon::parse($notification->created_at)->format('h:i A') }}</div>
									<div class="text-muted small">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
								</td>
								<td>
									<div class="d-flex align-items-center gap-2">
										@if($approvalId)
											<a href="{{ route('approvals.index') }}" class="btn btn-sm
											btn-outline-primary">
												<i class="fas fa-eye"></i> View
											</a>
										@endif

										@if(!$notification->read_at)
											<a href="{{ route('notifications.mark-as-read', $notification->id) }}"
											   class="btn btn-sm btn-outline-success"
											   onclick="event.preventDefault(); document.getElementById('mark-read-{{ $notification->id }}').submit();">
												<i class="fas fa-check"></i> Mark Read
											</a>
											<form id="mark-read-{{ $notification->id }}" action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST" class="d-none">
												@csrf
											</form>
										@else
											<span class="badge bg-light text-dark">Read {{ Carbon\Carbon::parse($notification->read_at)->diffForHumans() }}</span>
										@endif
									</div>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="4" class="text-center py-4">
									<div class="empty-state">
										<i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
										<h5>No notifications found</h5>
										<p class="text-muted">You don't have any notifications at the moment.</p>
									</div>
								</td>
							</tr>
						@endforelse
						</tbody>
					</table>
				</div>

				<div class="d-flex justify-content-center mt-4">
					{{ $notifications->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection

@push('style')
	<style>
        .notification-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-state {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .notification-filters .btn-group .btn.active {
            background-color: #0d6efd;
            color: white;
        }

        .table tr.table-light.fw-bold {
            position: relative;
        }

        .table tr.table-light.fw-bold::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background-color: #0d6efd;
        }
	</style>
@endpush

@push('script')
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const closeButton = alert.querySelector('.btn-close');
                    if (closeButton) {
                        closeButton.click();
                    }
                });
            }, 5000);
        });
	</script>
@endpush
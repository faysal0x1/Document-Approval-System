@auth
	<header>
		<div class="topbar d-flex align-items-center">
			<nav class="navbar navbar-expand">
				<div class="mobile-toggle-menu"><i class='fas fa-bars'></i>
				</div>
				<div class="search-bar flex-grow-1">
					<div class="position-relative search-bar-box" style="display: none;">
						<input type="text" class="form-control search-control d-hidden" placeholder="Type to search...">
						<span class="position-absolute top-50 search-show translate-middle-y"><i
									class='fas fa-search'></i></span>
						<span class="position-absolute top-50 search-close translate-middle-y"><i
									class='fas fa-times'></i></span>
					</div>
				</div>
				<div class="top-menu ms-auto" style="">
					<ul class="navbar-nav align-items-center">
						<li class="nav-item mobile-search-icon">
							<a class="nav-link" href="#"> <i class='fas fa-search'></i>
							</a>
						</li>
						<li class="nav-item dropdown dropdown-large">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
							   role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="alert-count">
            @if($notificationsCount > 0)
		        {{ $notificationsCount }}
	        @endif
        </span>
								<i class='fas fa-bell'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="msg-header d-flex justify-content-between align-items-center">
									<p class="msg-header-title mb-0">Notifications</p>
									@if($notificationsCount > 0)
										<a href="{{ route('notifications.mark-all-read') }}"
										   class="text-primary mark-all-read"
										   onclick="event.preventDefault(); document.getElementById('mark-all-read-form').submit();">
											Mark all as read
										</a>
										<form id="mark-all-read-form"
										      action="{{ route('notifications.mark-all-read') }}" method="POST"
										      class="d-none">
											@csrf
										</form>
									@endif
								</div>
								<div class="header-notifications-list">
									@forelse($notifications as $notification)
										<a class="dropdown-item notification-item {{ $notification->read_at ? 'read' : 'unread' }}"
										   href="{{ getNotificationUrl($notification) }}"
										   data-notification-id="{{ $notification->id }}">
											<div class="d-flex align-items-center">
												@php
													$iconClass = 'fas fa-bell';
													$bgClass = 'bg-light-primary';
													$textClass = 'text-primary';

													// Map notification types to specific icons and styles
													if(isset($notification->data['type'])) {
														switch($notification->data['type']) {
															case 'new_user':
																$iconClass = 'fas fa-users';
																break;
															case 'new_order':
																$iconClass = 'fas fa-shopping-cart';
																$bgClass = 'bg-light-danger';
																$textClass = 'text-danger';
																break;
															case 'document':
																$iconClass = 'fas fa-file';
																$bgClass = 'bg-light-success';
																$textClass = 'text-success';
																break;
															case 'approval':
																$iconClass = 'fas fa-check-square';
																$bgClass = 'bg-light-success';
																$textClass = 'text-success';
																break;
														}
													}
												@endphp

												<div class="notify {{ $bgClass }} {{ $textClass }}">
													<i class="{{ $iconClass }}"></i>
												</div>
												<div class="flex-grow-1">
													<div class="d-flex justify-content-between">
														<h6 class="msg-name">
															{{ $notification->data['title'] ?? 'Notification' }}
															<span class="msg-time float-end">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
														</h6>
														<div class="actions">
															<a href="{{ route('notifications.mark-as-read', $notification->id) }}"
															   class="mark-as-read-btn"
															   onclick="event.preventDefault(); markAsRead('{{ $notification->id }}')">
																<i class="fas fa-check-circle"></i>
															</a>
														</div>
													</div>
													<p class="msg-info">{{ $notification->data['message'] ?? '' }}</p>
												</div>
											</div>
										</a>
									@empty
										<div class="text-center p-3">
											<p>No new notifications</p>
										</div>
									@endforelse
								</div>
								<a href="{{ route('notifications.index') }}">
									<div class="text-center msg-footer">View All Notifications</div>
								</a>
							</div>
						</li>

						<li class="nav-item dropdown dropdown-large" style="display:none;">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
							   data-bs-toggle="dropdown" aria-expanded="false"> <i class='fas fa-th'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="row row-cols-3 g-3 p-3">
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-cosmic text-white"><i
													class='fas fa-users'></i>
										</div>
										<div class="app-title">Teams</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-burning text-white"><i
													class='fas fa-project-diagram'></i>
										</div>
										<div class="app-title">Projects</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-lush text-white"><i
													class='fas fa-tasks'></i>
										</div>
										<div class="app-title">Tasks</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i
													class='fas fa-bell'></i>
										</div>
										<div class="app-title">Feeds</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-blues text-dark"><i
													class='fas fa-file'></i>
										</div>
										<div class="app-title">Files</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-moonlit text-white"><i
													class='fas fa-exclamation-triangle'></i>
										</div>
										<div class="app-title">Alerts</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown dropdown-large" style="display:none;">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
							   role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
										class="alert-count">8</span>
								<i class='fas fa-comment-dots'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a href="javascript:">
									<div class="msg-header">
										<p class="msg-header-title">Messages</p>
										<p class="msg-header-clear ms-auto">Marks all as read</p>
									</div>
								</a>
								<div class="header-message-list">
									<a class="dropdown-item" href="javascript:">
										<div class="d-flex align-items-center">
											<div class="user-online">
												<img src="{{ asset('backend/images/avatars/avatar-1.png') }}"
												     class="msg-avatar" alt="user avatar">
											</div>
											<div class="flex-grow-1">
												<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
                                                    ago</span></h6>
												<p class="msg-info">The standard chunk of lorem</p>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:">
										<div class="d-flex align-items-center">
											<div class="user-online">
												<img src="{{ asset('backend/images/avatars/avatar-2.png') }}"
												     class="msg-avatar" alt="user avatar">
											</div>
											<div class="flex-grow-1">
												<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
                                                    sec ago</span></h6>
												<p class="msg-info">Many desktop publishing packages</p>
											</div>
										</div>
									</a>
								</div>
								<a href="javascript:">
									<div class="text-center msg-footer">View All Messages</div>
								</a>
							</div>
						</li>
					</ul>
				</div>

				<div class="user-box dropdown">
					<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
					   role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<img
								src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/no_image.jpg') }}"
								class="user-img" alt="user avatar">


						<div class="user-info ps-3">
							<p class="user-name mb-0">{{ auth()->user()->name }}</p>

						</div>
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
										class="fas fa-user"></i><span>Profile</span></a>
						</li>
						<li>
							<div class="dropdown-divider mb-0"></div>
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('logout') }}">
								<i class='fas fa-sign-out-alt'></i><span>
                                Logout
                            </span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
@endauth

<script>
    // Add this to your scripts
    document.addEventListener('DOMContentLoaded', function () {
        // Mark notification as read when clicked
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function (e) {
                // Don't interfere if clicking on the mark-as-read button
                if (e.target.closest('.mark-as-read-btn')) {
                    return;
                }

                const notificationId = this.dataset.notificationId;
                markAsRead(notificationId);

                // Continue with navigation to the notification URL
            });
        });
    });

    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI to show notification as read
                    const notificationElement = document.querySelector(`.notification-item[data-notification-id="${notificationId}"]`);
                    if (notificationElement) {
                        notificationElement.classList.remove('unread');
                        notificationElement.classList.add('read');
                    }

                    // Update notification counter
                    const counter = document.querySelector('.alert-count');
                    if (counter && counter.textContent) {
                        const count = parseInt(counter.textContent.trim()) - 1;
                        counter.textContent = count > 0 ? count : '';
                    }
                }
            })
            .catch(error => console.error('Error marking notification as read:', error));
    }
</script>
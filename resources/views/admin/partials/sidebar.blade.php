@php
	$role = auth()->user()?->roles()?->first()?->name ?? 'admin';
@endphp

@auth
	<div class="sidebar-wrapper" data-simplebar="true">
		<div class="sidebar-header">
			<div>
				<img src="{{ asset('site/logo.png') }}" class="logo-ic w-75" alt="logo icon">
			</div>
			<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
		</div>
		<!--navigation-->
		<ul class="metismenu" id="menu">
			@permission('dashboard_view')
			<li>
				<a href="{{ route($role . '.dashboard') }}" class="mt-2">
					<div class="parent-icon"><i class='bx bx-grid-alt'></i></div>
					<div class="menu-title">Dashboard</div>
				</a>
			</li>
			<hr>
			@endpermission

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="bx bx-store-alt"></i></div>
					<div class="menu-title">Workflows</div>
				</a>
				<ul>
					<li>
						<a href="{{ route($role.'.workflows.index') }}"><i class="bx bx-list-ul"></i>
							workflows List
						</a>
					</li>
				</ul>
			</li>

			<!-- Document Section -->
			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fas fa-file-alt"></i></div>
					<div class="menu-title">Documents</div>
				</a>
				<ul>

					<li>
						<a href="{{ route('documents.create') }}"
						   class="{{ request()->routeIs('documents.create') ? 'active' : '' }}">
							<i class="fas fa-plus-circle"></i> New Document
						</a>
					</li>
					<li>
						<a href="{{ route('documents.index') }}"
						   class="{{ request()->routeIs('documents.index') ? 'active' : '' }}">
							<i class="fas fa-list"></i> My Documents
						</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fas fa-thumbs-up"></i></div>
					<div class="menu-title">Approvals</div>
				</a>
				<ul>
					<li>
						<a href="{{ route('approvals.index') }}"
						   class="{{ request()->routeIs('approvals.*') ? 'active' : '' }}">
							<i class="fas fa-check-circle"></i> My Approvals
						</a>
					</li>
				</ul>
			</li>


			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="bx bx-shield"></i></div>
					<div class="menu-title">Settings</div>
				</a>
				<ul>
					<li>
						<a href="{{ url('/laratrust') }}"><i class="bx bx-user-check"></i>Role Assignment</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="bx bx-user-circle"></i></div>
					<div class="menu-title">Users</div>
				</a>
				<ul>
					<li>
						<a href="{{ route($role . '.user.index') }}"><i class="bx bx-list-ul"></i>List of
						                                                                          Users</a>
					</li>

				</ul>
			</li>
		</ul>
	</div>
@endauth

@php
	$role = auth()->user()?->roles()?->first()?->name ?? 'admin';
@endphp

@auth
	<div class="sidebar-wrapper" data-simplebar="true">
		<div class="sidebar-header">
			<div>
				<img src="{{ asset('site/logo.svg') }}" class="logo-ic w-75" alt="logo icon">
			</div>
			<div class="toggle-icon ms-auto"><i class="fa-solid fa-arrow-left"></i></div>
		</div>
		<!--navigation-->
		<ul class="metismenu" id="menu">
			@permission('dashboard_view')
			<li>
				<a href="{{ route($role . '.dashboard') }}" class="mt-2">
					<div class="parent-icon"><i class="fa-solid fa-table-cells-large"></i></div>
					<div class="menu-title">Dashboard</div>
				</a>
			</li>
			<hr>
			@endpermission

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fa-solid fa-shield"></i></div>
					<div class="menu-title">Workflows</div>
				</a>
				<ul>
					<li>
						<a href="{{ route($role.'.workflows.index') }}"><i class="fa-solid fa-list"></i>
							workflows List
						</a>
					</li>
				</ul>
			</li>

			<!-- Document Section -->
			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fa-solid fa-file-lines"></i></div>
					<div class="menu-title">Documents</div>
					@if($pendingDocumentsCount > 0)
						<span class="sidebar-badge">({{ $pendingDocumentsCount }})</span>
					@endif
				</a>
				<ul>
					<li>
						<a href="{{ route('documents.create') }}"
						   class="{{ request()->routeIs('documents.create') ? 'active' : '' }}">
							<i class="fa-solid fa-circle-plus"></i> New Document
						</a>
					</li>
					<li>
						<a href="{{ route('documents.index') }}"
						   class="{{ request()->routeIs('documents.index') ? 'active' : '' }}">
							<i class="fa-solid fa-list"></i> My Documents
							@if($pendingDocumentsCount > 0)
								<span class="sidebar-badge">({{ $pendingDocumentsCount }})</span>
							@endif
						</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fa-solid fa-thumbs-up"></i></div>
					<div class="menu-title">Approvals</div>
					@if($pendingApprovalsCount > 0)
						<span class="sidebar-badge badge-danger">  ({{ $pendingApprovalsCount }})</span>
					@endif
				</a>
				<ul>
					<li>
						<a href="{{ route('approvals.index') }}"
						   class="{{ request()->routeIs('approvals.*') ? 'active' : '' }}">
							<i class="fa-solid fa-circle-check"></i> My Approvals
						</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fa-solid fa-shield"></i></div>
					<div class="menu-title">Settings</div>
				</a>
				<ul>
					<li>
						<a href="{{ url('/laratrust') }}"><i class="fa-solid fa-user-check"></i>Role Assignment</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:" class="has-arrow">
					<div class="parent-icon"><i class="fa-solid fa-user-circle"></i></div>
					<div class="menu-title">Users</div>
				</a>
				<ul>
					<li>
						<a href="{{ route($role . '.user.index') }}"><i class="fa-solid fa-list"></i>List of Users</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
@endauth
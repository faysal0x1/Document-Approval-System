<div class="btn-group">
	<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
		Actions <span class="caret"></span>
	</button>
	<ul class="dropdown-menu dropdown-menu-left" role="menu">


		{{-- Load View Modal  --}}
		@if (isset($loadViewModal,$permission) && $loadViewModalRoute)
			@can($permission.'-view')
				<li>
					<a class="dropdown-item" href="#"
					   onclick="showViewModal(
                        '{{ route($role . $loadViewModalRoute, $id) }}',
                        '{{ $loadViewModal }}',
                        {id: '{{ $id }}'}
                    ); return false;">
						<i class="fas fa-eye
                    "></i> View
					</a>
				</li>
			@endcan
		@endif

		{{-- Load Edit Modal  --}}
		@if (isset($loadEditModal , $permission) && $loadEditModalRoute)
			@can($permission.'-edit')
				<li>
					<a class="dropdown-item" href="#"
					   onclick="loadEditModal(
                        '{{ route($role . $loadEditModalRoute, $id) }}',
                        '{{ $loadEditModal }}',
                        {id: '{{ $id }}'}
                    ); return false;">
						<i class="fas fa-edit"></i> Edit
					</a>
				</li>
			@endcan
		@endif
		{{-- Delete Option --}}
		@if (isset($deleteRoute, $permission) && $deleteRoute)
			@can($permission.'-delete')
				<li>
					<form action="{{ route($role . $deleteRoute, $id) }}" method="POST" class="delete-form">
						@csrf
						@method('DELETE')
						<button type="button" class="dropdown-item delete-btn" data-id="{{ $id }}"
						        data-model="{{ $model ?? '' }}">
							<i class="fas fa-trash"></i> Delete
						</button>
					</form>
				</li>

			@endcan
		@endif

	</ul>
</div>

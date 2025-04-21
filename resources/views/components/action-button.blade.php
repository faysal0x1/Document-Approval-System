<div class="action-buttons" style="display: flex; gap: 10px;">


	@if (isset($viewRoute) && $viewRoute)
		<a class="btn btn-info btn-sm" href="{{ route($viewRoute, $id) }}">
			<i class="fas fa-eye"></i>
		</a>
	@endif

	@if (isset($editRoute) && $editRoute)
		<a class="btn btn-primary btn-sm"
		   data-toggle="tooltip"
		   data-placement="top"
		   title="Edit"
		   href="{{ route($editRoute, $id) }}">
			<i class="fa fa-pencil-alt"></i>
		</a>
	@endif

	@if (isset($deleteRoute) && $deleteRoute)
		<form action="{{ route($deleteRoute, $id) }}" method="POST" class="delete-form">
			@csrf
			@method('DELETE')
			<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $id }}"
			        data-model="{{ $model ?? '' }}">
				<i class="fas fa-trash"></i>
			</button>
		</form>
	@endif
</div>
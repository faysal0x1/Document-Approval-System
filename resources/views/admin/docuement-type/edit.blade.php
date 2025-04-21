<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
     aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editModalLabel">Edit Department</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="editForm">
					@csrf
					@method('PUT')
					<input type="hidden" id="editDepartmentId" name="id">
					<div class="mb-3">
						<label for="editName" class="form-label"> Name</label>
						<input type="text" class="form-control" id="editName" name="name" required
						       value="{{$data->name}}">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary"
				        onclick="submitModalForm( 'editForm', '{{ route($role . 'document-types.update',
				        $data->id) }}', 'editModal', 'PUT' )">
					Update
				</button>
			</div>
		</div>
	</div>
</div>

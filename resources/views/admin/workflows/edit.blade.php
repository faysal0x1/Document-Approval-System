@extends('layouts.admin')

@section('content')
	<div class="container py-4">
		<h1 class="mb-4">Edit Workflow: {{ $workflow->name }}</h1>

		<form method="POST" action="{{ route($role.'workflows.update', $workflow) }}">
			@csrf @method('PUT')
			<div class="form-group mb-3">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{ old('name', $workflow->name) }}" required>
			</div>
			<div class="form-group mb-3">
				<label>Description</label>
				<textarea name="description" class="form-control">{{ old('description', $workflow->description) }}</textarea>
			</div>
			<div class="form-check mb-3">
				<input type="checkbox" name="is_active" class="form-check-input" id="is_active"
						{{ $workflow->is_active ? 'checked' : '' }}>
				<label class="form-check-label" for="is_active">Active</label>
			</div>
			<button type="submit" class="btn btn-primary">Update Workflow</button>
		</form>

		<hr class="my-4">

		<h2>Workflow Steps</h2>

		<table class="table table-bordered">
			<thead class="thead-light">
			<tr>
				<th>Step #</th>
				<th>Name</th>
				<th>Approver Type</th>
				<th>Approver Value</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			@foreach($workflow->steps as $step)
				<tr>
					<td>{{ $step->step_number }}</td>
					<td>{{ $step->name }}</td>
					<td>{{ ucfirst($step->approver_type) }}</td>
					<td>{{ $step->approver_value }}</td>
					<td>
						<button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
						        data-bs-target="#editStepModal" data-step="{{ $step->id }}"
						        data-name="{{ $step->name }}" data-description="{{ $step->description }}"
						        data-approver_type="{{ $step->approver_type }}"
						        data-approver_value="{{ $step->approver_value }}">
							Edit
						</button>
						<form action="{{ route($role.'steps.delete', $step) }}" method="POST" class="d-inline">
							@csrf @method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>

		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStepModal">Add Step</button>

		<!-- Add Step Modal -->
		<div class="modal fade" id="addStepModal" tabindex="-1" aria-labelledby="addStepModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="POST" action="{{ route($role.'workflows.steps.add', $workflow) }}">
						@csrf
						<div class="modal-header">
							<h5 class="modal-title" id="addStepModalLabel">Add Workflow Step</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="form-group mb-3">
								<label>Step Number</label>
								<input type="number" name="step_number" class="form-control" required min="1">
							</div>
							<div class="form-group mb-3">
								<label>Name</label>
								<input type="text" name="name" class="form-control" required>
							</div>
							<div class="form-group mb-3">
								<label>Approver Type</label>
								<select name="approver_type" class="form-control" required>
									<option value="role">Role</option>
									<option value="department">Department</option>
									<option value="user">User</option>
								</select>
							</div>
							<div class="form-group mb-3">
								<label>Approver Value</label>
								<input type="text" name="approver_value" class="form-control" required>
								<small class="text-muted">For role: role ID. For department: department ID</small>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Add Step</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Edit Step Modal -->
		<div class="modal fade" id="editStepModal" tabindex="-1" aria-labelledby="editStepModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="POST" action="" id="editStepForm">
						@csrf @method('PUT')
						<div class="modal-header">
							<h5 class="modal-title" id="editStepModalLabel">Edit Workflow Step</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="form-group mb-3">
								<label>Name</label>
								<input type="text" name="name" class="form-control" required>
							</div>
							<div class="form-group mb-3">
								<label>Approver Type</label>
								<select name="approver_type" class="form-control" required>
									<option value="role">Role</option>
									<option value="department">Department</option>
									<option value="user">User</option>
								</select>
							</div>
							<div class="form-group mb-3">
								<label>Approver Value</label>
								<input type="text" name="approver_value" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script>
        const editStepModal = document.getElementById('editStepModal');
        editStepModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const stepId = button.getAttribute('data-step');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const approverType = button.getAttribute('data-approver_type');
            const approverValue = button.getAttribute('data-approver_value');

            const form = document.getElementById('editStepForm');
            form.action = `/admin/steps/${stepId}`;
            form.querySelector('input[name="name"]').value = name;
            form.querySelector('textarea[name="description"]').value = description;
            form.querySelector('select[name="approver_type"]').value = approverType;
            form.querySelector('input[name="approver_value"]').value = approverValue;
        });
	</script>
@endpush

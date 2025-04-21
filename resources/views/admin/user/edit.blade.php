{{--     Add modal  --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editModalLabel">Add New User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="editForm" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<input type="hidden" id="editId" name="id">

					<div class="row">
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label for="editname" class="form-label">Name</label>
								<input type="text" name="editname" id="editname" class="form-control" required>
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label for="editemail" class="form-label">Email</label>

							<input type="email" name="editemail" id="editemail" class="form-control"
							       placeholder="Enter Email" required>

						</div>

						<div class="col-md-6 mb-3">
							<label for="editaddress" class="form-label">Address</label>
							<textarea name="editaddress" class="form-control" id="editaddress" cols="30"
							          rows=""></textarea>
						</div>

						<div class="col-md-6 mb-3">
							<label for="editphone">Phone</label>
							<input type="text" name="editphone" id="editphone" class="form-control" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="editPassword">Password</label>
							<input type="password" name="editPassword" id="editPassword" class="form-control"
							       placeholder="Enter Password (Optional)" value="">
						</div>

						<div class="col-md-6 mb-3">
							<label for="editrole">Role</label>
							<select name="roles[]" id="editrole" class="form-control select2" multiple>
								<option value="" disabled>Select Role</option>
								@foreach ($allRoles as $roles)
									<option value="{{ $roles->name }}">
										{{ $roles->name }}
									</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="editCompany">Company</label>
							<select name="editCompany" id="editCompany" class="form-control select2">
								<option value="" disabled>Select Role</option>
								@foreach ($allCompany as $item)
									<option value="{{ $item->id }}">
										{{ $item->name }}
									</option>
								@endforeach
							</select>
						</div>


						<div class="col-md-6 mt-3">
							<div class="form-group">
								<label for="editphoto">Image</label>
								<input type="file" name="editphoto" class="form-control form-input" id="editphoto"> <br>
								<img id="editshowImage" class="form-check-input" src="{{ url('upload/no_image.jpg') }}"
								     alt="Admin" style="width:100px; height: 100px;">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="updateStore()">Save User</button>
			</div>
		</div>
	</div>
</div>

<script>
    function openEditModal(editUrl) {
        showLoader();
        //console.log('Opening edit modal with URL:', editUrl);

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function (response) {
                //console.log('Received response:', response);

                if (response && typeof response === 'object') {
                    $('#editId').val(response.id);
                    $('#editname').val(response.name);
                    $('#editemail').val(response.email);
                    $('#editaddress').val(response.address);

                    $('#editphone').val(response.phone);

                    let roleNames = response.roles.map(role => role.name);
                    $('#editrole').val(roleNames).trigger('change');

                    $('#editCompany').val(response.company_id).trigger('change');

                    if (response.photo && response.photo !== null) {
                        $('#editshowImage').attr('src', window.location.origin + "/" + response.photo);
                    } else {
                        $('#editshowImage').attr('src', window.location.origin + "/upload/no_image.jpg");
                    }
                    // Note: We don't set the document input, as it's a file input

                    $('#editModal').modal('show');
                } else {
                    console.error('Invalid response format:', response);
                    alert('Received invalid data from the server.');
                }

                hideLoader();
            },
            error: function (xhr, status, error) {
                console.error('Error fetching purchase data:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText
                });
                hideLoader();
                alert('Error fetching purchase data. Please check the console for more information.');
            }
        });
    }

    // Update Function
    function updateStore() {
        showLoader();
        const userId = $('#editId').val();
        const updateUrl = `{{ route($role . 'user.update', ':id') }}`.replace(':id', userId);


        let formData = new FormData($('#editForm')[0]); // Create a FormData object

        // console.log('Update URL:', updateUrl);

        $.ajax({
            url: updateUrl,
            method: 'POST',
            data: formData,
            contentType: false, // Prevent jQuery from setting content type
            processData: false, // Prevent jQuery from processing the data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#editModal').modal('hide');
                $('#editForm')[0].reset();
                hideLoader();
                AjaxNotifications.success('User updated successfully');
                loadTable();
            },
            error: function (xhr) {
                let response = xhr.responseText;
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    response = {
                        message: 'An error occurred'
                    };
                }

                if (xhr.status === 422) {
                    let errorMessages = [];
                    for (let field in response.errors) {
                        errorMessages = errorMessages.concat(response.errors[field]);
                    }
                    AjaxNotifications.error(errorMessages.join('<br>'));
                } else {
                    AjaxNotifications.error(response.message || 'An error occurred');
                }
                console.error('Error creating sell:', response);
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('#editphoto').change(function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function (event) {
                $('#editshowImage').attr('src', event.target.result);
            }

            reader.readAsDataURL(file);
        });
    });
</script>

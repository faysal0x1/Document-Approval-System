{{--     Add modal  --}}
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="userModalLabel">Add New User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="userForm" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label for="name" class="form-label">Name</label>
								<input type="text" name="name" id="name" class="form-control" required>
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email"
							       required>
						</div>

						<div class="col-md-6 mb-3">
							<label for="address" class="form-label">Address</label>
							<textarea name="address" class="form-control" id="address" cols="30" rows=""></textarea>
						</div>

						<div class="col-md-6 mb-3">
							<label for="phone">Phone</label>
							<input type="text" name="phone" id="phone" class="form-control" required>
						</div>
						<div class="col-md-7 mb-3">
							<label for="role">Role</label>
							<select name="roles[]" id="role" class="form-control select2" multiple>
								<option value="" disabled>Select Role</option>
								@foreach ($allRoles as $roles)
									<option value="{{ $roles->name }}">
										{{ $roles->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-6 mb-3">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" required>
						</div>


						<div class="col-md-6 mb-3">
							<label for="company">Company</label>
							<select name="company" id="company" class="form-control select2">
								@foreach ($allCompany as $company)
									<option value="{{ $company->id }}">
										{{ $company->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-6 mt-3">
							<div class="form-group">
								<label for="photo">Image</label>
								<input type="file" name="photo" class="form-control form-input" id="photo"> <br>
								<img id="showImage" class="form-check-input" src="{{ url('upload/no_image.jpg') }}"
								     alt="Admin" style="width:100px; height: 100px;">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
{{-- 				<button type="button" class="btn btn-primary" onclick="submitForm()">Save User</button> --}}
				<button type="button" class="btn btn-primary" onclick="submitModalForm(
                    'userForm',  '{{ route($role . 'user.store') }}', 'userModal' )">
					Save Department
				</button>
			</div>
		</div>
	</div>
</div>

{{-- <script> --}}
{{--      --}}{{--function submitForm() {--}}
{{--      --}}{{--    var formData = new FormData($('#userForm')[0]);--}}
{{--      --}}{{--    $.ajax({--}}
{{--      --}}{{--        url: "{{ route($role . 'user.store') }}",--}}
{{--      --}}{{--        method: 'POST',--}}
{{--      --}}{{--        data: formData,--}}
{{--      --}}{{--        processData: false,--}}
{{--      --}}{{--        contentType: false,--}}
{{--      --}}{{--        headers: {--}}
{{--      --}}{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--      --}}{{--        },--}}
{{--      --}}{{--        success: function (response) {--}}
{{--      --}}{{--            $('#userModal').modal('hide');--}}
{{--      --}}{{--            $('#userForm')[0].reset();--}}
{{--      --}}{{--            loadTable();--}}
{{--      --}}{{--            AjaxNotifications.success('User created successfully');--}}
{{--      --}}{{--        },--}}
{{--      --}}{{--        error: function (xhr) {--}}
{{--      --}}{{--            let response = xhr.responseText;--}}
{{--      --}}{{--            try {--}}
{{--      --}}{{--                response = JSON.parse(response);--}}
{{--      --}}{{--            } catch (e) {--}}
{{--      --}}{{--                response = {--}}
{{--      --}}{{--                    message: 'An error occurred'--}}
{{--      --}}{{--                };--}}
{{--      --}}{{--            }--}}

{{--      --}}{{--            if (xhr.status === 422) {--}}
{{--      --}}{{--                let errorMessages = [];--}}
{{--      --}}{{--                for (let field in response.errors) {--}}
{{--      --}}{{--                    errorMessages = errorMessages.concat(response.errors[field]);--}}
{{--      --}}{{--                }--}}
{{--      --}}{{--                AjaxNotifications.error(errorMessages.join('<br>'));--}}
{{--      --}}{{--            } else {--}}
{{--      --}}{{--                AjaxNotifications.error(response.message || 'An error occurred');--}}
{{--      --}}{{--            }--}}
{{--      --}}{{--            console.error('Error creating sell:', response);--}}
{{--      --}}{{--        }--}}

{{--      --}}{{--    });--}}
{{--      --}}{{--}--}}

{{--      --}}{{--$('#userForm').on('submit', function (e) {--}}
{{--      --}}{{--    //e.preventDefault();--}}
{{--      --}}{{--    submitForm();--}}

{{--      --}}{{--});--}}
{{-- </script> --}}
{{-- <script> --}}
{{--     $(document).ready(function () { --}}
{{--         $('#photo').change(function (e) { --}}
{{--             var file = e.target.files[0]; --}}
{{--             var reader = new FileReader(); --}}
{{--             reader.onload = function (event) { --}}
{{--                 $('#showImage').attr('src', event.target.result); --}}
{{--             } --}}
{{--             reader.readAsDataURL(file); --}}
{{--         }); --}}
{{--     }); --}}
{{-- </script> --}}

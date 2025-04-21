@extends('layouts.admin')

@section('title', 'User List')
@push('style')
	@include('import.css.datatable')

	<style>
        .store-item {
            display: block;
            margin-bottom: 3px;
            line-height: 1.5;
        }
	</style>
@endpush

@section('content')

	<x-breadcumb title="User List"/>
	<div class="table-responsive">
		<div class="dashboard-card">
			<div class="card-header-section">
				<div class="table-title-section">
					<div class="table-icon">
						<i class="fas fa-project-diagram"></i>
					</div>
					<h5 class="table-title">User Overview</h5>
				</div>
				<div class="header-actions">
					<button
							type="button"
							class="btn btn-primary"
							onclick="loadAddModal('{{ route($role . 'user.create') }}', 'userModal')"
					>
						Add New User
					</button>

				</div>
			</div>
			<div class="table-responsive">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>SL</th>
									<th>Action</th>
									<th>Status</th>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Company</th>
									<th>Role</th>
									<th>Assigned Stores</th>
									<th>Store Assignment</th>
								</tr>
								</thead>
								<tbody>

								</tbody>

							</table>
						</div>
					</div>
				</div>
			</div>

		</div>


		<!-- Assign Stores modal -->
		@include('admin.user.assignStoreModal', ['stores' => $stores])
{{--		@include('admin.user.create')--}}
		@include('admin.user.edit')


		@push('script')
			<script>
                initializeSelect2();
                function initializeSelect2(element) {
                    let target = element ? element.find('.select2') : $('.select2');
                    target.select2({
                        width: '80%',
                        // dropdownAutoWidth: true
                    });
                }
			</script>

			@include('import.js.datatable')
			<script>
                loadTable();
                function loadTable() {
                    const columns = [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'company',
                            name: 'company'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'stores',
                            name: 'stores',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'store_assignment',
                            name: 'store_assignment',
                            orderable: false,
                            searchable: false
                        },

                    ];
                    initDataTable
                    (
                        '#example2',
                        '{{ route($role . 'user.index') }}',
                        columns
                    )
                }
			</script>
			<script>
                $(document).ready(function () {
                    $(document).on('click', '.assign-stores-btn', function () {
                        const userId = $(this).data('id');
                        $('#assignStoresUserId').val(userId);

                        // Clear previous selections
                        $('#storeSelect').val([]);

                        // Fetch current assigned stores
                        $.ajax({
                            url: `/users/${userId}/stores`,
                            method: 'GET',
                            success: function (response) {
                                // Preselect currently assigned stores
                                const assignedStoreIds = response.assigned_stores.map(store => store.id);
                                $('#storeSelect').val(assignedStoreIds);
                            }
                        });

                        // Show the modal
                        $('#assignStoresModal').modal('show');
                    });
                    // Save assigned stores
                    $('#saveAssignedStores').on('click', function () {
                        const userId = $('#assignStoresUserId').val();
                        const selectedStores = $('#storeSelect').val();
                        $.ajax({
                            url: `/users/${userId}/assign-stores`,
                            method: 'POST',
                            data: {
                                stores: selectedStores,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                toastr.success(response.message);
                                $('#assignStoresModal').modal('hide');

                                // Optionally refresh the datatable
                                $('#example2').DataTable().ajax.reload();
                            },
                            error: function (xhr) {
                                toastr.error('Failed to assign stores');
                            }
                        });
                    });
                });
			</script>
	@endpush
@endsection

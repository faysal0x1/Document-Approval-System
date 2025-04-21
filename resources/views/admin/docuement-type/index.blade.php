@extends('layouts.admin')
@section('title', 'Document Type List')

@push('style')
	@include('import.css.datatable')
@endpush

@section('content')
	<x-breadcumb title="Document Type List"/>
	<div class="table-responsive">

		<div class="dashboard-card">
			<div class="card-header-section">
				<div class="table-title-section">
					<div class="table-icon">
						<i class="fas fa-project-diagram"></i>
					</div>
					<h5 class="table-title">Document Type Overview</h5>
				</div>
				<div class="header-actions">

					<button
							type="button"
							class="btn btn-primary"
							onclick="loadAddModal('{{ route($role . 'document-types.create') }}', 'addModal')"
					>
						Add New Document Type
					</button>

				</div>
			</div>
			<div class="table-responsive">
				<table id="example2" class="table table-hover">
					<thead>
					<tr>
						<th>SL</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

	</div>
@endsection

@push('script')
	@include('import.js.datatable')

	<script>
        loadTable();

        function loadTable() {
            const columns = [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name', orderable: true},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ];
            initDataTable(
                '#example2',
                '{{ route($role . 'document-types.index') }}',
                columns
            );
        }
	</script>
@endpush

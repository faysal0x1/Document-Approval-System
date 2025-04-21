@extends('layouts.admin')

@section('title', 'Permission')

@push('style')
	@include('import.css.datatable')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
@endpush


@section('content')

	<main id="content" role="main" class="main pointer-event">


		@include('vendor.partials.navbar')

		<div class="flex flex-col">
			@if (config('laratrust.panel.create_permissions'))
				{{--                 <a href="{{ route('laratrust.permissions.create') }}" --}}
				{{--                     class="self-end bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"> --}}
				{{--                     + New Permission --}}
				{{--                 </a> --}}
			@endif
			<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
				<div
						class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
					<table id="permissionTable" class="min-w-full">
						<thead>
						<tr>
							<th class="th">Id</th>
							<th class="th">Name/Code</th>
							<th class="th">Display Name</th>
							<th class="th">Description</th>
							<th class="th"></th>
						</tr>
						</thead>
						<tbody class="bg-white">
						@foreach ($permissions as $permission)
							<tr>
								<td class="td text-sm leading-5 text-gray-900">
									{{ $permission->getKey() }}
								</td>
								<td class="td text-sm leading-5 text-gray-900">
									{{ $permission->name }}
								</td>
								<td class="td text-sm leading-5 text-gray-900">
									{{ $permission->display_name }}
								</td>
								<td class="td text-sm leading-5 text-gray-900">
									{{ $permission->description }}
								</td>
								<td
										class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
									<a href="{{ route('laratrust.permissions.edit', $permission->getKey()) }}"
									   class="text-blue-600 hover:text-blue-900">Edit</a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{ $permissions->links('laratrust::panel.pagination') }}
	</main>
@endsection



@push('script')
	@include('import.js.datatable')
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
	<script>
        $(document).ready(function () {
            $('#permissionTable').DataTable({

                paging: false,
                searching: true,
                ordering: true, // Enable sorting
                info: true, // Show table information
                autoWidth: false, // Disable automatic column width calculation
                responsive: true, // Enable responsive behavior
                columnDefs: [
                    {orderable: false, targets: [4]} // Disable sorting for the "Actions" column
                ]
            });
        });
	</script>
@endpush
<style>
    .dropdown-item {
        padding: 0.5rem 1rem;
        cursor: pointer;
    }

    .dropdown-item i {
        margin-right: 0.5rem;
        width: 1rem;
    }

    .delete-form .dropdown-item {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        color: inherit;
    }

    .delete-form .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #dc3545;
    }
</style>

<link href="{{ asset('backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet"/>

<link rel="stylesheet" href="{{ asset('backend/css/custom-datatable.css') }}"/>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
{{--     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
      rel="stylesheet">

@extends('layouts.admin')

@section('title', 'Dashboard')

@push('style')
    @include('import.css.datatable')
    <style>
        .filter-dropdown {
            position: relative;
            display: inline-block;
        }

        .filter-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            min-width: 200px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filter-menu.show {
            display: block;
        }

        .filter-item {
            padding: 8px 15px;
            cursor: pointer;
        }

        .filter-item:hover {
            background-color: #f8f9fa;
        }

        .select2-container {
            min-width: 200px;
        }
    </style>
@endpush

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Dashboard Overview</h4>


    </div>

    <div id="dashboardContent">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

        </div>
    </div>

@endsection

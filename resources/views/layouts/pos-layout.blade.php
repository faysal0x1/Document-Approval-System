<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!--favicon-->
	<link rel="icon" href="{{ asset('backend/images/favicon-32x32.png') }}" type="image/png"/>
	<!--plugins-->
	<link href="{{ asset('backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
	<link href="{{ asset('backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet"/>
	<link href="{{ asset('backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>
	<!-- loader-->
	{{--	--}}{{-- <link href="{{ asset('backend/css/pace.min.css') }}" rel="stylesheet"/>--}}
	{{-- 	<script src="{{ asset('backend/js/pace.min.js') }}"></script> --}}
	<!-- Bootstrap CSS -->
	<link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

	{{-- 	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}

	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('backend/css/dark-theme.css') }}"/>

	<link rel="stylesheet" href="{{ asset('backend/css/semi-dark.css') }}"/>
	<link rel="stylesheet" href="{{ asset('backend/css/header-colors.css') }}"/>
	<link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}"/>


	@livewireStyles
	<title>
		@yield('title')
	</title>

	@vite(['resources/css/app.css', 'resources/js/app.js'])

	<link rel="stylesheet" href="{{asset('backend/css/select2-bootstrap.css')}}">
	@stack('style')
	{{--     Date Picker --}}
	<x-flatpickr::style/>
	{{-- 	<script defer src="{{asset('backend/js/alpine-js-3-48.js')}}"></script> --}}
</head>

<body>
<div id="globalLoader" style="display: none;">
	<div class="spinner-border text-primary" role="status">
		<span class="visually-hidden">Loading...</span>
	</div>
</div>
<!--wrapper-->
<div class="wrapper toggled">
	<!--sidebar wrapper -->
	@include('admin.partials.pos.sidebar')
	<!--end sidebar wrapper -->
	<!--start header -->
	@include('admin.partials.header')
	<!--end header -->
	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			@yield('content')
		</div>
	</div>

	{{--     modal Container --}}
	<div id="modalContainer"></div>

	<!--end page wrapper -->
	<!--start overlay-->
	<div class="overlay toggle-icon"></div>
	<!--end overlay-->
	<!--Start Back To Top Button-->

	<a href="javaScript:" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	<!--End Back To Top Button-->
	<footer class="page-footer">
		<p class="mb-0">Copyright © {{ date('Y') }}. All right reserved.</p>
	</footer>
</div>
<!--end wrapper-->
<!--start switcher-->

<!--end switcher-->

<!--plugins-->
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('backend/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('backend/js/index.js') }}"></script>

<script src="{{ asset('backend/js/app.js') }}"></script>
<script>
    // Add this script at the bottom of your sidebar.blade.php file or in a separate JS file
    document.addEventListener('DOMContentLoaded', function () {
        // Get the sidebar element
        const sidebar = document.querySelector('.sidebar-wrapper');

        // Restore scroll position on page load
        const savedScrollPosition = localStorage.getItem('sidebarScrollPosition');
        if (savedScrollPosition) {
            sidebar.scrollTop = parseInt(savedScrollPosition);
        }

        // Save scroll position before navigating away
        const menuLinks = document.querySelectorAll('#menu a[href]');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                localStorage.setItem('sidebarScrollPosition', sidebar.scrollTop);
            });
        });

        // Highlight the current active menu item
        const currentPath = window.location.pathname;
        menuLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath ||
                currentPath.startsWith(link.getAttribute('href'))) {
                link.closest('li').classList.add('mm-active');
                const parentUl = link.closest('ul');
                if (parentUl && parentUl.closest('li')) {
                    parentUl.closest('li').classList.add('mm-active');
                    parentUl.style.display = 'block';
                }
            }
        });
    });
</script>

<script src="{{asset('backend/js/modal-handler.js')}}"></script>

{{-- Flat Picker --}}
<x-flatpickr::script/>


<script defer src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="{{ asset('backend/js/sweetalert.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>
<script src="{{ asset('backend/js/select2.js') }}"></script>


<script>
    $(".toggleswitch-checkbox").change(function () {
        var model = $(this).data("model");
        var id = $(this).data("id");
        var state = $(this).prop("checked");
        var checkbox = $(this);

        console.log(model, id, state);

        Swal.fire({
            title: "Are you sure?",
            text: "You want to change the status!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .get(`/toggle-status/${model}/${id}`)
                    .then((response) => {
                        Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: "The status has been updated.",
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: "top-end",
                        });
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "There was an issue updating the status.",
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: "top-end",
                        });
                        checkbox.prop("checked", !state); // Revert the toggle switch
                    });
            } else {
                checkbox.prop("checked", !state); // Revert the toggle switch
            }
        });
    });
</script>

{{--     Loader --}}
<script>
    function showLoader() {
        $('#globalLoader').show();
    }

    function hideLoader() {
        $('#globalLoader').hide();
    }
</script>
<link rel="stylesheet" href="{{asset('backend/css/toastr.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


{{-- <script src="{{ asset('backend/js/custom.js') }}"></script> --}}
{{-- Toastify JS --}}
@include('admin.partials.toastr')

@livewireScripts
@stack('script')


</body>

</html>

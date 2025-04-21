@extends('layouts.admin')
@section('title', 'Account Exists')
@section('content')

				<div class="card">
					<div class="card-header">
						<h5 class="card-title">
							{{__("Account Balance Previous Exists")}}
						</h5>
					</div>


					<form method="POST" action="{{route('account.store')}}">
						@csrf

						<div class="card-body">
							<div class="row mt-5 mb-5">

								<div class="col-md-4"></div>
								<div class="col-md-4">
									<a href="{{ route('accountTransactionClose', $accountBalance->date) }}" class="btn btn-warning only-confirm-button"
									   data-confirmation-message="Are you sure to close the Accounts?"
									   data-purpose-message="This will close the Accounts and lock the transactions."
									>
										<i class="fa fa-window-close"></i>&nbsp; Accounts Close For Previous Accounts
									</a>
								</div>

							</div>
						</div>


					</form>
				</div>

@endsection


@push('style')

	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>

	<style type="text/css">

        .select2 {
            width: 20% !important;
        }

	</style>

@endpush

@push('script')

	<script src="{{asset('assets/js/select2.min.js')}}"></script>

	<script type="text/javascript">


        $(function () {

            $('.select2').select2();

        });

	</script>

@endpush

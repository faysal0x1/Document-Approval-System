@extends('layouts.admin')
@section('title', 'Create Account Transaction')

@section('content')
			<div class="card">

				<div class="card-header">
					<div class="row">
						<div class="col-md-4">
							<h2 class="text-bold">
								{{__("Create Account Transaction")}}
								{{--<b class="text-warning">{{ $accountBalance->shop->name ?? "NAN" }}</b> Shop--}}
							</h2>
						</div>

						<div class="col-md-4 text-center">
							<h2 class="text-bold">
								{{--Cash: <b class="text-warning">{{ $accountBalance->start_cash_amount }}</b> TK--}}
							</h2>
						</div>

						<div class="col-md-4 text-right">
							<a href="{{route($role.'account-transaction.index')}}" class="btn btn-warning text-right">
								<i class="fa fa-arrow-left"></i> &nbsp; {{__("Back")}}
							</a>
						</div>
					</div>
				</div>

				<form method="POST" action="{{route($role.'account-transaction.store')}}">
					@csrf
					<input type="hidden" name="created_by_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

					<div class="card-body">
						{{--@foreach($accountBalances as $accountBalanceHidden)
							<input type="text" name="transactions[0][account_balance_id]" value="{{ $accountBalanceHidden->id }}">
						@endforeach--}}

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered" id="purchaseItemsTable">
										<colgroup>
											<col style="width: 35%">
											<col style="width: 10%">
											<col style="width: 10%">
											<col style="width: 10%">
											<col style="width: 10%">
											<col style="width: 5%">
										</colgroup>
										<thead>
										<tr>
											<th>{{ __('Account Name') }}</th>
											<th>{{ __('Transaction Type') }}</th>
											<th>{{ __('Amount') }}</th>
											<th>{{ __('Source') }}</th>
											<th>{{ __('Description') }}</th>
											<th>
												<button type="button" class="btn btn-sm btn-default" id="addItem">
													<i class="fa fa-plus"></i> {{ __('Add More') }}
												</button>
											</th>
										</tr>
										</thead>
										<tbody>
										<tr class="item-row">
											<td>
												<select class="form-control select2 account-select" name="transactions[0][account_id]" data-index="0" required>
													<option value="">{{ __('Select Account') }}</option>
													@forelse($accountBalances as $accountBalance)
														<option value="{{ $accountBalance->account_id }}">
															{{ $accountBalance->account->name }}
														</option>
													@empty
														<option value="">{{ __('No Accounts Available') }}</option>
													@endforelse
												</select>
											</td>

											<td>
												<select class="form-control select2" name="transactions[0][transaction_type]" required>
													<option value="">{{ __('Select Type') }}</option>
													<option value="income">Income</option>
													<option value="expense">Expense</option>
												</select>
											</td>
											<td>
												<input type="number" step="0.01" class="form-input px-1 py-1 sale-unit-price" name="transactions[0][amount]" required>
											</td>

											<td>
												<input type="text" step="0.01" class="form-input px-1 py-2" name="transactions[0][transaction_source]">
											</td>
											<td>
												<input type="text" step="0.01" class="form-input px-1 py-2" name="transactions[0][description]">
											</td>

											<td>
												<button type="button" class="btn btn-danger btn-sm remove-item">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										</tbody>
										<tfoot>
										<tr>
											<td colspan="12">
												{{--<button type="button" class="btn btn-default" id="addItem">
													<i class="fa fa-plus"></i> {{ __('Add More') }}
												</button>--}}
											</td>
										</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="card-footer bg-default">
						<button type="submit" class="btn btn-primary">
							{{ __('Create') }}
						</button>
					</div>
				</form>

			</div>
@endsection

@push('style')
	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
	<style>
        .select2-container {
            width: 100% !important;
            min-width: 150px;
        }

        .select2-dropdown {
            width: auto !important;
            min-width: 150px !important;
            max-width: 230px !important;
        }

        #purchaseItemsTable td:first-child {
            width: 35%;
            min-width: 250px;
            max-width: 400px;
        }

        .select2-container--default .select2-results > .select2-results__options {
            max-width: 400px;
        }

        .select2-results__option {
            white-space: normal;
            word-wrap: break-word;
        }
	</style>
@endpush
@push('script')
	<script src="{{ asset('assets/js/select2.min.js') }}"></script>
	<script>
        $(function () {
            initializeSelect2();

            let itemIndex = 0;

            function initializeSelect2(element) {
                let target = element ? element.find('.select2') : $('.select2');
                target.select2({
                    // width: '100%',
                    dropdownAutoWidth: true
                });
            }

            $('#addItem').click(function () {
                itemIndex++;
                let newRow = $('.item-row:first').clone();

                // Properly destroy select2
                newRow.find('.select2').each(function () {
                    if ($(this).data('select2')) {
                        $(this).select2('destroy');
                    }
                });

                // Clean up
                newRow.find('input').val('');
                newRow.find('select').val('');
                newRow.find('.select2-container').remove();

                // Update names
                newRow.find('select, input').each(function () {
                    let name = $(this).attr('name');
                    if (name) {
                        $(this).attr('name', name.replace(/\[\d+\]/, '[' + itemIndex + ']'));
                    }
                });

                // Append and initialize
                $('#purch@extends('layouts.master')
				                @section('title', 'Create Account Transaction')

				                @section('content')
                        <div class="page-wrapper">
                    <div class="container-fluid">
                    <div class="card">

                    <div class="card-header">
                    <div class="row">
                    <div class="col-md-4">
                    <h2 class="text-bold">
			            {{__("Create Account Transaction")}}
					            {{--<b class="text-warning">{{ $accountBalance->shop->name ?? "NAN" }}</b> Shop--}}
                    </h2>
            </div>

                <div class="col-md-4 text-center">
                    <h2 class="text-bold">
			            {{--Cash: <b class="text-warning">{{ $accountBalance->start_cash_amount }}</b> TK--}}
                    </h2>
                </div>

                <div class="col-md-4 text-right">
                    <a href="{{route('account-transaction.index')}}" class="btn btn-warning text-right">
                        <i class="fa fa-arrow-left"></i> &nbsp; {{__("Back")}}
                    </a>
                </div>
            </div>
            </div>

                <form method="POST" action="{{route('account-transaction.store')}}">
		            @csrf
                    <input type="hidden" name="created_by_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                    <div class="card-body">
			            {{--@foreach($accountBalances as $accountBalanceHidden)
                            <input type="text" name="transactions[0][account_balance_id]" value="{{ $accountBalanceHidden->id }}">
                        @endforeach--}}

                        <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="purchaseItemsTable">
                                    <colgroup>
                                        <col style="width: 35%">
                                            <col style="width: 10%">
                                                <col style="width: 10%">
                                                    <col style="width: 10%">
                                                        <col style="width: 10%">
                                                            <col style="width: 5%">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>{{ __('Account Name') }}</th>
                                        <th>{{ __('Transaction Type') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Source') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>
                                            <button type="button" class="btn btn-sm btn-default" id="addItem">
                                                <i class="fa fa-plus"></i> {{ __('Add More') }}
                                            </button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="item-row">
                                        <td>
                                            <select class="form-control select2 account-select" name="transactions[0][account_id]" data-index="0" required>
                                                <option value="">{{ __('Select Account') }}</option>
									            @forelse($accountBalances as $accountBalance)
                                                <option value="{{ $accountBalance->account_id }}">
									            {{ $accountBalance->account->name }}
                                                </option>
									            @empty
                                                <option value="">{{ __('No Accounts Available') }}</option>
									            @endforelse
                                            </select>
                                        </td>

                                        <td>
                                            <select class="form-control select2" name="transactions[0][transaction_type]" required>
                                                <option value="">{{ __('Select Type') }}</option>
                                                <option value="income">Income</option>
                                                <option value="expense">Expense</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" class="form-input px-1 py-1 sale-unit-price" name="transactions[0][amount]" required>
                                        </td>

                                        <td>
                                            <input type="text" step="0.01" class="form-input px-1 py-2" name="transactions[0][transaction_source]">
                                        </td>
                                        <td>
                                            <input type="text" step="0.01" class="form-input px-1 py-2" name="transactions[0][description]">
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-item">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="12">
								            {{--<button type="button" class="btn btn-default" id="addItem">
                                                    <i class="fa fa-plus"></i> {{ __('Add More') }}
                                                </button>--}}
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="card-footer bg-default">
                        <button type="submit" class="btn btn-primary">
				            {{ __('Create') }}
                        </button>
                    </div>
                </form>

            </div>
            </div>
            </div>
	            @endsection

	            @push('styles')
                <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
                <style>
                    .select2-container {
                    width: 100% !important;
                    min-width: 150px;
                }

                    .select2-dropdown {
                    width: auto !important;
                    min-width: 150px !important;
                    max-width: 230px !important;
                }

                    #purchaseItemsTable td:first-child {
                    width: 35%;
                    min-width: 250px;
                    max-width: 400px;
                }

                    .select2-container--default .select2-results > .select2-results__options {
                    max-width: 400px;
                }

                    .select2-results__option {
                    white-space: normal;
                    word-wrap: break-word;
                }
                </style>
	            @endpush
	            @push('scripts')
                <script src="{{ asset('assets/js/select2.min.js') }}"></script>
	<script>
        $(function () {
            initializeSelect2();

            let itemIndex = 0;

            function initializeSelect2(element) {
                let target = element ? element.find('.select2') : $('.select2');
                target.select2({
                    // width: '100%',
                    dropdownAutoWidth: true
                });
            }

            $('#addItem').click(function () {
                itemIndex++;
                let newRow = $('.item-row:first').clone();

                // Properly destroy select2
                newRow.find('.select2').each(function () {
                    if ($(this).data('select2')) {
                        $(this).select2('destroy');
                    }
                });

                // Clean up
                newRow.find('input').val('');
                newRow.find('select').val('');
                newRow.find('.select2-container').remove();

                // Update names
                newRow.find('select, input').each(function () {
                    let name = $(this).attr('name');
                    if (name) {
                        $(this).attr('name', name.replace(/\[\d+\]/, '[' + itemIndex + ']'));
                    }
                });

                // Append and initialize
                $('#purchaseItemsTable tbody').append(newRow);
                initializeSelect2(newRow);
            });

            // Remove item handler
            $(document).on('click', '.remove-item', function () {
                if ($('.item-row').length > 1) {
                    $(this).closest('tr').remove();
                }
            });
        });
	</script>

@endpush
aseItemsTable tbody').append(newRow);
                initializeSelect2(newRow);
            });

            // Remove item handler
            $(document).on('click', '.remove-item', function () {
                if ($('.item-row').length > 1) {
                    $(this).closest('tr').remove();
                }
            });
        });
	</script>

@endpush

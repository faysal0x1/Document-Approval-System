@php use Carbon\Carbon; @endphp
<div class="document-content">
	<div class="table-responsive">
		<table class="table table-bordered">
			<tbody>
			<tr>
				<th width="30%">Employee Name</th>
				<td>{{ $document->submitter->name }}</td>
			</tr>
			<tr>
				<th>Expense Date</th>
				<td>{{ Carbon::parse($content['expense_date'])->format('M d, Y') }}</td>
			</tr>
			<tr>
				<th>Amount</th>
				<td>{{ config('app.currency') }}{{ number_format($content['amount'], 2) }}</td>
			</tr>
			<tr>
				<th>Category</th>
				<td>{{ ucfirst($content['category'] ?? 'Not specified') }}</td>
			</tr>
			<tr>
				<th>Description</th>
				<td>{!! nl2br(e($content['description'])) !!}</td>
			</tr>
			</tbody>
		</table>
	</div>

	@if(isset($content['expense_items']))
		<div class="expense-items mt-4">
			<h6>Expense Items:</h6>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>Date</th>
					<th>Description</th>
					<th>Amount</th>
				</tr>
				</thead>
				<tbody>
				@foreach($content['expense_items'] as $item)
					<tr>
						<td>{{ Carbon::parse($item['date'])->format('M d') }}</td>
						<td>{{ $item['description'] }}</td>
						<td>{{ config('app.currency') }}{{ number_format($item['amount'], 2) }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	@endif
</div>
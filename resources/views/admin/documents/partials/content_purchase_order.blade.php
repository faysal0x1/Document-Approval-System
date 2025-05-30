@php use Carbon\Carbon; @endphp
<div class="document-content">
	<div class="table-responsive">
		<table class="table table-bordered">
			<tbody>
			<tr>
				<th width="30%">Requested By</th>
				<td>{{ $document->submitter->name }}</td>
			</tr>
			<tr>
				<th>Supplier</th>
				<td>{{ $content['supplier'] }}</td>
			</tr>
			<tr>
				<th>Request Date</th>
				<td>{{ $document->created_at->format('M d, Y') }}</td>
			</tr>
			@if(isset($content['delivery_date']))
				<tr>
					<th>Required By</th>
					<td>{{ Carbon::parse($content['delivery_date'])->format('M d, Y') }}</td>
				</tr>
			@endif
			<tr>
				<th>Priority</th>
				<td>
                        <span class="badge badge-{{ $content['priority'] === 'high' ? 'danger' : ($content['priority'] === 'medium' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($content['priority'] ?? 'normal') }}
                        </span>
				</td>
			</tr>
			</tbody>
		</table>
	</div>

	<div class="order-items mt-4">
		<h6>Items Requested:</h6>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>Item</th>
				<th>Description</th>
				<th>Qty</th>
				<th>Unit Price</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			@foreach($content['items'] as $item)
				<tr>
					<td>{{ $item['code'] ?? 'N/A' }}</td>
					<td>{{ $item['description'] }}</td>
					<td>{{ $item['quantity'] }}</td>
					<td>{{ config('app.currency') }}{{ number_format($item['unit_price'], 2) }}</td>
					<td>{{ config('app.currency') }}{{ number_format($item['quantity'] * $item['unit_price'], 2) }}</td>
				</tr>
			@endforeach
			<tr class="table-active">
				<td colspan="4" class="text-right font-weight-bold">Subtotal</td>
				<td class="font-weight-bold">
					{{ config('app.currency') }}{{ number_format(array_reduce($content['items'], function($carry, $item) { return $carry + ($item['quantity'] * $item['unit_price']); }, 0), 2) }}
				</td>
			</tr>
			</tbody>
		</table>
	</div>

	@if(isset($content['special_instructions']))
		<div class="special-instructions mt-3">
			<h6>Special Instructions:</h6>
			<div class="card">
				<div class="card-body">
					{!! nl2br(e($content['special_instructions'])) !!}
				</div>
			</div>
		</div>
	@endif
</div>
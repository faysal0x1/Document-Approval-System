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
				<th>Leave Type</th>
				<td>{{ $content['leave_type'] ?? 'Not specified' }}</td>
			</tr>
			<tr>
				<th>Start Date</th>
				<td>{{ Carbon::parse($content['start_date'])->format('M d, Y (l)') }}</td>
			</tr>
			<tr>
				<th>End Date</th>
				<td>{{ Carbon::parse($content['end_date'])->format('M d, Y (l)') }}</td>
			</tr>
			<tr>
				<th>Total Days</th>
				<td>
					{{ Carbon::parse($content['start_date'])->diffInDays(Carbon::parse($content['end_date'])) + 1 }}
					day(s)
				</td>
			</tr>
			<tr>
				<th>Reason</th>
				<td>{{ $content['reason'] ?? 'Not specified' }}</td>
			</tr>
			@if(isset($content['contact_during_absence']))
				<tr>
					<th>Emergency Contact</th>
					<td>
						{{ $content['contact_during_absence'] }}
						@if(isset($content['contact_phone']))
							<br><small>Phone: {{ $content['contact_phone'] }}</small>
						@endif
					</td>
				</tr>
			@endif
			</tbody>
		</table>
	</div>

	@if(isset($content['additional_notes']))
		<div class="additional-notes mt-3">
			<h6>Additional Notes:</h6>
			<div class="card">
				<div class="card-body">
					{!! nl2br(e($content['additional_notes'])) !!}
				</div>
			</div>
		</div>
	@endif
</div>

<style>
    .document-content table th {
        background-color: #f8f9fa;
    }

    .additional-notes .card-body {
        white-space: pre-line;
    }
</style>
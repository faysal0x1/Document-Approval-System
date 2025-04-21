<!-- resources/views/documents/forms/leave_application.blade.php -->
<div class="form-group row">
	<label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

	<div class="col-md-6">
		<input id="start_date" type="date" class="form-control @error('content.start_date') is-invalid @enderror" name="content[start_date]" value="{{ old('content.start_date') }}" required>

		@error('content.start_date')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>

<div class="form-group row">
	<label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

	<div class="col-md-6">
		<input id="end_date" type="date" class="form-control @error('content.end_date') is-invalid @enderror" name="content[end_date]" value="{{ old('content.end_date') }}" required>

		@error('content.end_date')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>

<div class="form-group row">
	<label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

	<div class="col-md-6">
		<textarea id="reason" class="form-control @error('content.reason') is-invalid @enderror" name="content[reason]" required>{{ old('content.reason') }}</textarea>

		@error('content.reason')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>
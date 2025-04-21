<!-- resources/views/documents/forms/expense_claim.blade.php -->
<div class="form-group row">
	<label for="expense_date" class="col-md-4 col-form-label text-md-right">{{ __('Expense Date') }}</label>

	<div class="col-md-6">
		<input id="expense_date" type="date" class="form-control @error('content.expense_date') is-invalid @enderror" name="content[expense_date]" value="{{ old('content.expense_date') }}" required>

		@error('content.expense_date')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>

<div class="form-group row">
	<label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

	<div class="col-md-6">
		<input id="amount" type="number" step="0.01" class="form-control @error('content.amount') is-invalid @enderror" name="content[amount]" value="{{ old('content.amount') }}" required>

		@error('content.amount')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>

<div class="form-group row">
	<label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

	<div class="col-md-6">
		<select id="category" class="form-control @error('content.category') is-invalid @enderror" name="content[category]" required>
			<option value="travel">{{ __('Travel') }}</option>
			<option value="meals">{{ __('Meals') }}</option>
			<option value="accommodation">{{ __('Accommodation') }}</option>
			<option value="other">{{ __('Other') }}</option>
		</select>

		@error('content.category')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>

<div class="form-group row">
	<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

	<div class="col-md-6">
		<textarea id="description" class="form-control @error('content.description') is-invalid @enderror" name="content[description]" required>{{ old('content.description') }}</textarea>

		@error('content.description')
		<span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
	</div>
</div>
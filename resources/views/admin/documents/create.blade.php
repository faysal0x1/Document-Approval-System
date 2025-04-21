@extends('layouts.admin')

@section('content')
	<div class="container py-4">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="card shadow-sm">
					<div class="card-header h5 fw-bold">Submit New Document</div>

					<div class="card-body">
						<form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
							@csrf

							<div class="mb-3 row">
								<label for="type" class="col-sm-4 col-form-label text-end">Document Type</label>
								<div class="col-sm-8">
									<select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
										<option value="">Select Document Type</option>
										@foreach($workflows as $workflow)
											<option value="{{ $workflow->document_type }}" {{ old('type') == $workflow->document_type ? 'selected' : '' }}>
												{{ $workflow->name }}
											</option>
										@endforeach
									</select>
									@error('type')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>

							<!-- Dynamic Fields -->
							<div id="document-fields"></div>

							<div class="mb-3 row">
								<label for="attachments" class="col-sm-4 col-form-label text-end">Attachments</label>
								<div class="col-sm-8">
									<input type="file" id="attachments" name="attachments[]" class="form-control @error('attachments') is-invalid @enderror" multiple>
									@error('attachments')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>

							<div class="row">
								<div class="offset-sm-4 col-sm-8">
									<button type="submit" class="btn btn-primary">
										Submit Document
									</button>
								</div>
							</div>
						</form>
					</div> <!-- card-body -->
				</div> <!-- card -->
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type');
            const fieldsContainer = document.getElementById('document-fields');

            const documentFields = {
                'leave_application': `
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Start Date</label>
                    <div class="col-sm-8">
                        <input type="date" name="content[start_date]" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">End Date</label>
                    <div class="col-sm-8">
                        <input type="date" name="content[end_date]" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Reason</label>
                    <div class="col-sm-8">
                        <textarea name="content[reason]" class="form-control" required></textarea>
                    </div>
                </div>
            `,
                'expense_claim': `
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Expense Date</label>
                    <div class="col-sm-8">
                        <input type="date" name="content[expense_date]" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Amount</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" name="content[amount]" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Description</label>
                    <div class="col-sm-8">
                        <textarea name="content[description]" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Category</label>
                    <div class="col-sm-8">
                        <select name="content[category]" class="form-select" required>
                            <option value="travel">Travel</option>
                            <option value="meals">Meals</option>
                            <option value="accommodation">Accommodation</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            `,
                'purchase_order': `
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Supplier</label>
                    <div class="col-sm-8">
                        <input type="text" name="content[supplier]" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Items</label>
                    <div class="col-sm-8">
                        <div id="po-items">
                            <div class="item-row mb-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="content[items][0][description]" placeholder="Description" required>
                                    <input type="number" class="form-control" name="content[items][0][quantity]" placeholder="Qty" required>
                                    <input type="number" step="0.01" class="form-control" name="content[items][0][unit_price]" placeholder="Unit Price" required>
                                    <button class="btn btn-outline-danger remove-item" type="button">×</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-item">Add Item</button>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label text-end">Delivery Date</label>
                    <div class="col-sm-8">
                        <input type="date" name="content[delivery_date]" class="form-control">
                    </div>
                </div>
            `
            };

            typeSelect.addEventListener('change', function () {
                const selectedType = this.value;
                fieldsContainer.innerHTML = documentFields[selectedType] || '';

                if (selectedType === 'purchase_order') {
                    initPurchaseOrderItems();
                }
            });

            function initPurchaseOrderItems() {
                const itemsContainer = document.getElementById('po-items');
                const addButton = document.getElementById('add-item');
                let itemCount = 1;

                addButton.addEventListener('click', function () {
                    const newItem = document.createElement('div');
                    newItem.className = 'item-row mb-2';
                    newItem.innerHTML = `
                    <div class="input-group">
                        <input type="text" class="form-control" name="content[items][${itemCount}][description]" placeholder="Description" required>
                        <input type="number" class="form-control" name="content[items][${itemCount}][quantity]" placeholder="Qty" required>
                        <input type="number" step="0.01" class="form-control" name="content[items][${itemCount}][unit_price]" placeholder="Unit Price" required>
                        <button class="btn btn-outline-danger remove-item" type="button">×</button>
                    </div>
                `;
                    itemsContainer.appendChild(newItem);
                    itemCount++;
                });

                itemsContainer.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-item')) {
                        e.target.closest('.item-row').remove();
                    }
                });
            }

            if (typeSelect.value) {
                typeSelect.dispatchEvent(new Event('change'));
            }
        });
	</script>
@endpush

<div class="modal fade" id="assignStoresModal" tabindex="-1" aria-labelledby="assignStoresModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignStoresModalLabel">Assign Stores to User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignStoresForm">
                    <input type="hidden" id="assignStoresUserId" name="user_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="storeSelect">Select Stores</label>
                                <select id="storeSelect" class="form-control select2" multiple="multiple" name="stores[]">
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveAssignedStores">Save Stores</button>
            </div>
        </div>
    </div>
</div>



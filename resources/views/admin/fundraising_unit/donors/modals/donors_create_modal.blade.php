<div id="donors-create-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="donors_create_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Donors create</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4" id="donors_input_modal">
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Arabic name</label>
                                    <input type="text" class="form-control" id="donors_arabic" placeholder="John">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-2" class="form-label">English name</label>
                                    <input type="text" class="form-control" id="donors_english" placeholder="Doe">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="form-label">Fax</label>
                                    <input type="text" class="form-control" id="fax" placeholder="Fax">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="form-label">Website</label>
                                    <input type="text" class="form-control" id="website" placeholder="Website">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="form-label">Work field</label>
                                    <input type="text" class="form-control" id="work_field" placeholder="Work field">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-3" class="form-label">Region</label>
                                    <select name="" id="donors_region_id" class="js-example-basic-single select2 form-control">
                                        <option value="">Select Region</option>
                                        @foreach($regions as $key)
                                            <option value="{{ $key->regions_id }}">{{ $key->regions_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-3" class="form-label">Category</label>
                                    <select name="" id="donors_donors_categories_id" class="js-example-basic-single select2 form-control">
                                        <option value="">Select Category</option>
                                        @foreach($category_donors as $key)
                                            <option value="{{ $key->donors_categories_id }}">{{ $key->donors_categories_arabic_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="donors_is_partner" name="checkbox"> Is partner
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="save_donors_btn()" class="btn btn-info waves-effect waves-light">Save
                            changes</button>
                    </div>
                </form>
        </div>
    </div>
</div>

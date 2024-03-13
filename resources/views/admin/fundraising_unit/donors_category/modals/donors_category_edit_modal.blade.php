<div id="donors-category-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="donors_category_form_edit" enctype="multipart/form-data">
                <input type="hidden" name="id" id="donors_category_id">
                <div class="modal-header">
                    <h4 class="modal-title">Donors category edit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-1" class="form-label">Arabic Donors category</label>
                                <input type="text" class="form-control" name="donors_categories_arabic_name" id="donors_categories_arabic_name" placeholder="John">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">English Donors category</label>
                                <input type="text" class="form-control" name="donors_categories_english_name" id="donors_categories_english_name" placeholder="Doe">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Update
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

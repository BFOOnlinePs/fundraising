<div id="region-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="region_id">
            <form action="{{ route('settings.region.create') }}" method="post">
                @csrf
                <div class="modal-header">
                    <span>Add region</span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Region name</label>
                                <input type="text" id="regions_name_edit" name="regions_name_edit" class="form-control" placeholder="Region name">
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="update_region_ajax()" class="btn btn-success mt-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

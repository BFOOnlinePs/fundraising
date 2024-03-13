<div id="region-create-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
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
                                <input type="text" name="regions_name" class="form-control" placeholder="Region name">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

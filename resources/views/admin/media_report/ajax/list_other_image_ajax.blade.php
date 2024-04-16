@foreach($data as $key)
    <div class="col-md-3" id="media_report_attachment_{{ $key->id }}">
            <div class="card border p-3 m-3">
                <button type="button" onclick="delete_other_attachment_ajax({{ $key->id }})" class="btn btn-default btn-sm"><span class="fa fa-close text-danger"></span></button>
                <div class="card-body">
                    <a href="{{ asset('storage/media_report/'.$key->filename_with_extension) }}" target="_blank">
                        <h4>
                            <p class="bg-success-subtle rounded-circle p-2 float-start text-center" style="width: 30px;height: 30px">{{ ($loop->index) + 1 }}</p>
                            <p class="h4" style="margin-left: 40px">{{ $key->extension }}</p>
                        </h4>
                        <hr>
                        <h5>{{ $key->filename_with_extension }}</h5>
                    </a>
                </div>
            </div>
    </div>
@endforeach

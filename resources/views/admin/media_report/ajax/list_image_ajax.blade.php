    @foreach($data as $key)
        <div class="col-md-3">
            <span onclick="delete_image_ajax({{ $key->id }})" class="remove-btn text-danger">&times;</span>
            <img src="{{ asset('storage/media_report/'.$key->file) }}" onclick="get_image_path_for_modal('{{ asset('storage/media_report/'.$key->file) }}')" class="img-fluid avatar-md rounded" alt="Preview Image">
        </div>
    @endforeach

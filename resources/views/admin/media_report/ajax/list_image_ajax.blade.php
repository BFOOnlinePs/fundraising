    @foreach($data as $key)
        <div class="preview-item col-md-3">
            <span onclick="delete_image_ajax({{ $key->id }})" class="remove-btn text-danger">&times;</span>
            <img src="{{ asset('storage/media_report/'.$key->file) }}" width="250px" alt="Preview Image">
        </div>
    @endforeach

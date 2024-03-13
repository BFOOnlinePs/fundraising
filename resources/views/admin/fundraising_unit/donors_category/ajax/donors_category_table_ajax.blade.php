<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Donors category Arabic</th>
            <th>Donors category English</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key)
        <tr>
            <td>{{ $key->donors_categories_arabic_name }}</td>
            <td>{{ $key->donors_categories_english_name }}</td>
            <td>
                <button onclick="get_data_from_donors_category({{ $key }})" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

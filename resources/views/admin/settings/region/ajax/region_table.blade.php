<table class="table-bordered table table-hover">
    <thead>
    <tr>
        <th>Regions name</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if($data->isEmpty())
        <tr>
            <td colspan="2" class="text-center"></td>
        </tr>
    @else
        @foreach($data as $key)
            <tr>
                <td>{{ $key->regions_name }}</td>
                <td>
                    <button onclick="get_data_from_region({{ $key }})" class="btn btn-success"><span class="fa fa-edit"></span></button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

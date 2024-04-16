<table class="table table-sm table-hover table-bordered">
    <thead>
        <tr>
            <th>Reference number</th>
            <th>Ar name</th>
            <th>En name</th>
            <th>Description</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Budget</th>
            <th>Currency</th>
            <th>Call</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="10" class="text-center">No Data</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->reference_number }}</td>
                    <td>{{ $key->project_name_ar }}</td>
                    <td>{{ $key->project_name_en }}</td>
                    <td>{{ $key->project_drscription }}</td>
                    <td>{{ $key->planned_start_date }}</td>
                    <td>{{ $key->planned_end_date }}</td>
                    <td>{{ $key->budget }}</td>
                    <td>{{ $key->currency_id }}</td>
                    <td>{{ $key->call_id }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('projects.edit',['id'=>$key->id]) }}"><span class="fa fa-edit"></span></a>
                        <a class="btn btn-sm btn-dark" href=""><span class="fa fa-search"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{ $data->links() }}

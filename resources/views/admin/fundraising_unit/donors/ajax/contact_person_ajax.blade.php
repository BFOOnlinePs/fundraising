<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Position</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if($data->isEmpty())
        <tr>
            <td colspan="6" class="text-center">No data</td>
        </tr>
    @else
        @foreach($data as $key)
            <tr>
                <td>{{ $key->contact_person_name }}</td>
                <td>{{ $key->contact_person_phone }}</td>
                <td>{{ $key->contact_person_email }}</td>
                <td>{{ $key->contact_person_gender }}</td>
                <td>{{ $key->contact_person_position }}</td>
                <td></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="select-all">
            </th>
            <th>Arabic name</th>
            <th>English name</th>
            <th>Email</th>
            <th>Region</th>
            <th>Category</th>
            <th>Fax</th>
            <th>Address</th>
            <th>Website</th>
            <th>Work field</th>
            <th>Is partner</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="10" class="text-center">No data</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>
                        <input type="checkbox" name="checkbox[]" class="checkbox">
                    </td>
                    <td>{{ $key->donors_arabic_name }}</td>
                    <td>{{ $key->donors_english_name }}</td>
                    <td>{{ $key->email }}</td>
                    <td>{{ $key->region->regions_name ?? '' }}</td>
                    <td>{{ $key->category->donors_categories_english_name ?? '' }}</td>
                    <td>{{ $key->fax ?? '' }}</td>
                    <td>{{ $key->address ?? '' }}</td>
                    <td>{{ $key->website ?? '' }}</td>
                    <td>{{ $key->work_field ?? '' }}</td>
                    <td>
                        @if($key->donors_is_partner == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        <button onclick="get_data_for_edit_donors({{ $key }})" class="btn btn-success"><span class="fa fa-edit"></span></button>
                        <button onclick="location.href='{{ route('fundraising_unit.donors.details',['id'=>$key->donors_id])  }}'"  class="btn btn-dark"><span class="fa fa-search"></span></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script>
    $(document).ready(function(){
        $('#select-all').click(function(event) {
            if(this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('#send-email').click(function() {
            var emails = [];
            $('.checkbox:checked').each(function() {
                var email = $(this).closest('tr').find('td:eq(3)').text();
                emails.push(email.trim());
            });
            var mailtoLink = 'mailto:' + emails.join(';');
            $(this).attr('href', mailtoLink);
        });
    });
</script>

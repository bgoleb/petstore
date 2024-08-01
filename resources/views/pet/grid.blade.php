<div>
    <table class="table table-bordered">
        <th>id</th>
        <th>name</th>
        <th>status</th>
        <th>category</th>
        <th>tags</th>
        <th></th>
        <tbody >
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet['id'] ?? '--' }}</td>
                    <td>{{ $pet['name'] ?? '--' }}</td>
                    <td>{{ $pet['status'] ?? '--' }}</td>
                    <td>{{ isset($pet['category']['name']) ? $pet['category']['name'] : '--' }}</td>
                    <td>{{ isset($pet['tags']) ? implode(', ', array_column($pet['tags'], 'name')) : '--' }}</td>
                    <td>
                        <a class="btn btn-primary" href="/pet/{{ $pet['id'] }}">pokaż</a>
                        <a class="btn btn-primary" href="/pet/edit/{{ $pet['id'] }}">edytuj</a>
                        <form action="/pet/{{ $pet['id'] }}" method="POST">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger" onclick="alert('Czy jesteś pewien?')">usuń</button>
                        </form>
                    </td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</div>

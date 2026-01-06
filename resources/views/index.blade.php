@include('masterlayout.header')
<div class="container">
    <h2>All Projects</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project['id'] }}</th>
                    <td>{{ $project['name'] }}</td>
                    <td><img src="{{ URL::asset('assets/images/' . $project['image']) }}" alt="" width="100">
                    </td>
                    <td>{{ $project['status'] }}</td>
                    <td><a href="{{ route('projectdetails', ['project' => $project['id']]) }}"><button
                                class="btn btn-primary">View Details</button></a></td>
                    <td><a href="{{ route('projectupdate', ['project' => $project['id']]) }}"><button
                                class="btn btn-primary">Edit</button></a></td>
                    <td><a href="{{ route('projectdelete', ['project' => $project['id']]) }}"><button
                                class="btn btn-danger">Delete</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('masterlayout.footer')

@include('masterlayout.header')
<div class="container mt-4">
    <h2>{{ $project['name'] }}</h2>

    <div class="row">
        <div class="col-4">
            <h5 class="mt-4"> <b> Project Details</b></h5>
            <ul>
                <li><b>Name : </b>{{ $project['name'] }}</li>
                <li><b>Status : </b>{{ $project['status'] }}</li>
                <li><b>Budget : </b>{{ $project['budget'] }}</li>
                <li><b>Currency : </b>{{ $project['currency'] }}</li>
                <li><b>Tags : </b>
                    {{-- @php
                        $tags= json_decoded($project['tags']);
                    @endphp --}}
                    @foreach ($project['tags'] as $tag)
                        {{ $tag }}, 
                    @endforeach
                <li><b>Started At : </b>{{ $project['started_at'] }}</li>
                <li><b>Completed at : </b>{{ $project['completed_at'] ?? 'N/A' }}</li>
            </ul>
        </div>
         <div class="col-4">
            <h5 class="mt-4"> <b> Client Details</b></h5>
            <ul>
                <li><b>Name : </b>{{ $project['client']['name'] }}</li>
                <li><b>Email : </b>{{ $project['client']['email'] }}</li>
                <li><b>Phone No. : </b>{{ $project['client']['phone'] }}</li>
            </ul>
            <h5 class="mt-4"> <b> Manager Details</b></h5>
            <ul>
                <li><b>Name : </b>{{ $project['manager']['name'] ?? 'Not Found' }}</li>
                <li><b>Email : </b>{{ $project['manager']['email'] ?? 'Not Found' }}</li>
            </ul>
        </div>
        <div class="col-4">
            @foreach ($project['tasks'] as $task)
                <h5 class="mt-4"> <b> Tasks</b></h5>
                <ul>
                    <li><b>Name : </b>{{ $task['title'] }}</li>
                    <li><b>Status : </b>{{ $task['status'] }}</li>
                    <li><b>Priority : </b>{{ $task['priority'] }}</li>
                    <li><b>Due Date : </b>{{ $task['due_date'] }}</li>
                    <li><b>Completed Date : </b>{{ $task['completed_at'] }}</li>
                    <h6 class="mt-4"> <b>Assign : </b></h6>
                    <li><b>Name : </b>{{ $task['assignee']['name'] ?? 'Unassigned' }}</li>
                    <li><b>Email : </b>{{ $task['assignee']['email'] ?? 'Unassigned' }}</li>

                    <h6 class="mt-4"> <b>Comments : </b></h6>
                    @if ($task['comments'])
                        @foreach ($task['comments'] as $comment)
                            <li><b>Message : </b>{{ $comment['message'] ?? 'Not Found' }}</li>
                            <li><b>Created At : </b>{{ $comment['created_at'] ?? 'Not Found' }}</li>
                        @endforeach
                    @endif
                   
                </ul>
            @endforeach
        </div>
    </div>
</div>
@include('masterlayout.footer')
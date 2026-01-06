@include('masterlayout.header')
<div class="container">
    <h2>Add Projects</h2>
    <form class="mt-4" action="{{ route('projectsave') }}" method="POST">
        @csrf
        @php
            $totalproject = count($projects);
        @endphp
        <input type="hidden" name="id" value="{{ $totalproject + 1 }}">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name"
                        placeholder="Enter Name">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" name="client" id="client" aria-describedby="client"
                        placeholder="Enter client name">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="email">Client Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                        placeholder="Enter client email">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date"
                        aria-describedby="start_date">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="complete_date">Complete Date</label>
                    <input type="date" class="form-control" name="complete_date" id="complete_date"
                        aria-describedby="complete_date">
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
</div>
@include('masterlayout.footer')

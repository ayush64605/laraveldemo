@include('masterlayout.header')

<div class="container">
    <h2>{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h2>

    <form class="mt-4" action="{{ route('project.save') }}" method="POST">
        @csrf

        {{-- ID --}}
        <input type="hidden" name="id"
            value="{{ $project['id'] ?? (count($projects ?? []) + 1) }}">

        <div class="row">

            <div class="col-4">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name"
                        value="{{ $project['name'] ?? '' }}"
                        placeholder="Enter Name">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Active"
                            {{ (isset($project) && $project['status'] == 'Active') ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="Completed"
                            {{ (isset($project) && $project['status'] == 'Completed') ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Client</label>
                    <input type="text" class="form-control" name="client"
                        value="{{ $project['client'] ?? '' }}"
                        placeholder="Enter client name">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Client Email</label>
                    <input type="email" class="form-control" name="email"
                        value="{{ $project['email'] ?? '' }}"
                        placeholder="Enter client email">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" class="form-control" name="start_date"
                        value="{{ $project['started_at'] ?? '' }}">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label>Complete Date</label>
                    <input type="date" class="form-control" name="complete_date"
                        value="{{ $project['completed_at'] ?? '' }}">
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-4">
            {{ isset($project) ? 'Update Project' : 'Add Project' }}
        </button>
    </form>
</div>

@include('masterlayout.footer')

<div id="logs-view" class="hidden">
    <div class="flex flex-row">
        <div class="flex-1 p-4">
            <select id="model-type" class="select select-bordered select-lg my-2"
                onchange="searchTable('activity-table', this.value)">
                <option selected disabled>Pick a model type</option>
                <option value="USER">USER</option>
                <option value="MEMBERS">MEMBERS</option>
                <option value="OUTLETS">OUTLETS</option>
                <option value="PACKAGES">PACKAGES</option>
                <option value="TRANSACTIONS">TRANSACTIONS</option>
            </select>

            <div class="overflow-x-auto">
                <table class="table w-full" id="activity-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Actions</th>
                            <th>From</th>
                            <th>At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityData as $logs)
                            <tr>
                                <td>{{ $logs->id }}</td>
                                <td>{{ $logs->activity_type }}</td>
                                <td>{{ $logs->model_type }}</td>
                                <td>{{ $logs->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

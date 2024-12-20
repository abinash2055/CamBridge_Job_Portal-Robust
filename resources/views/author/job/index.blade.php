@extends('layouts.account')

@section('content')
    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
            Job Applications
        </div>
        <div class="account-bdy p-3">
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <p class="mb-3 alert alert-primary">Listing all the Applicants who applied for your <strong>job
                            listings</strong>.</p>

                    {{-- all Application, Shortlisted and Rejected part --}}
                    <div class="d-flex">
                        <a href="{{ route('author.job.applications.index') }}" class="btn btn-primary me-3"
                            aria-label="View all applications">
                            All Applications
                        </a>
                        <a href="{{ route('author.job.applications.pending') }}" class="btn btn-warning me-3"
                            aria-label="View pending applications">
                            Pending Applications
                        </a>
                        <a href="{{ route('author.job.applications.shortlisted') }}" class="btn btn-success me-3"
                            aria-label="View shortlisted applications">
                            Shortlisted Applications
                        </a>
                        <a href="{{ route('author.job.applications.rejected') }}" class="btn btn-danger"
                            aria-label="View rejected applications">
                            Rejected Applications
                        </a>
                    </div>

                    <div id="application-data">

                        <div class="table-responsive pt-3">
                            <table class="table table-hover table-striped small">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Applicant Name</th>
                                        <th>Email</th>
                                        <th>Job Title</th>
                                        <th>Applied on</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($applications && $applications->count())
                                        @foreach ($applications as $application)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ optional($application->user)->name }}</td>

                                                <td>
                                                    <a
                                                        href="mailto:{{ optional($application->user)->email }}">{{ optional($application->user)->email }}</a>
                                                </td>

                                                <td><a
                                                        href="{{ route('author.jobApplication.showJob', $application->post->id) }}">{{ substr(optional($application->post)->job_title, 0, 14) }}...</a>
                                                </td>

                                                <td>{{ $application->created_at }}</td>

                                                <td id="status-{{ $application->id }}">{{ ucfirst($application->status) }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('author.jobApplication.show', ['id' => $application->id]) }}"
                                                        class="btn primary-outline-btn">View</a>
                                                </td>

                                                <td>
                                                    <form
                                                        action="{{ route('author.job.applications.reject', ['id' => $application->id]) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="application_id"
                                                            value="{{ $application->id }}">
                                                        <button type="submit" class="btn btn-danger">Reject</button>
                                                        {{-- <td>
                                                    <form
                                                        action="#"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="application_id"
                                                            value="{{ $application->id }}">
                                                    <button type="submit" class="btn danger-btn">Delete</button>
                                                </td> --}}
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>You haven't received any job applications.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        {{-- Page Number Pagination --}}
                        {{-- <div class="d-flex justify-content-center mt-4 custom-pagination">
                        {{ $applications && $applications->links() }}
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- Reject Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Reject Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to Reject the Application <strong></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- For Status --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.filter-btn');
        const dataContainer = document.getElementById('application-data');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');
                filterData(filter);
            });
        });

        function filterData(filter) {
            let filteredData = data;
            if (filter !== 'all') {
                filteredData = data.filter(item => item.status === filter);
            }

            dataContainer.innerHTML = '';
            filteredData.forEach(item => {
                const div = document.createElement('div');
                div.textContent = item.content;
                dataContainer.appendChild(div);
            });
        }
    });
</script>

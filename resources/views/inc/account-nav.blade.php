<div class="account-nav">
    <ul class="list-group">

        @role('admin')
            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="account-nav-link">
                    <i class="fas fa-chart-line"></i>Dashboard
                </a>
            </li>

            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'authors' ? 'active' : '' }}">
                <a href="{{ route('admin.author.index') }}" class="account-nav-link">
                    <i class="fas fa-microchip"></i> Author List
                </a>
            </li>


            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'view-all-users' ? 'active' : '' }}">
                <a href="{{ route('admin.user.viewAllUsers') }}" class="account-nav-link">
                    <i class="fas fa-users"></i> View All Users
                </a>
            </li>

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'view-all-posts' ? 'active' : '' }}">
                <a href="{{ route('admin.post.viewAll') }}" class="account-nav-link">
                    <i class="fas fa-chair"></i> View All Jobs
                </a>
            </li>

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2.5) == 'faq-categories' ? 'active' : '' }}">
                <a href="{{ route('faqs-categories.index') }}" class="account-nav-link">
                    <i class="fas fa-user"></i> FAQ Details
                </a>
            </li>
        @endrole


        @role('author')
            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'author-section' ? 'active' : '' }}">
                <a href="{{ route('author.authorSection') }}" class="account-nav-link">
                    <i class="fas fa-chart-line"></i> Author Section
            </li>

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'post' && request()->segment(3) == 'create' ? 'active' : '' }}">
                <a href="{{ route('author.post.create') }}" class="account-nav-link">
                    <i class="fas fa-plus-square"></i> Create Job listing
            </li>

            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'overview' ? 'active' : '' }}">
                <a href="{{ route('account.overview') }}" class="account-nav-link">
                    <i class="fas fa-user-shield"></i> Author Account
                </a>
            </li>

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'job-application' ? 'active' : '' }}">
                <a href="{{ route('author.jobApplication.index') }}" class="account-nav-link">
                    <i class="fas fa-users"></i> Job Applications
            </li>

            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'deactivate' ? 'active' : '' }}">
                <a href="{{ route('account.deactivate') }}" class="account-nav-link">
                    <i class="fas fa-folder-minus"></i> Deactivate Account
                </a>
            </li>
        @endrole



        @role('user')
            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'overview' ? 'active' : '' }}">
                <a href="{{ route('account.overview') }}" class="account-nav-link">
                    <i class="fas fa-user-shield"></i> User Account
                </a>
            </li>

            {{-- <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'become-employer' ? 'active' : '' }}">
                <a href="{{ route('account.becomeEmployer') }}" class="account-nav-link">
                    <i class="fas fa-user-shield"></i> Become an employer
                </a>
            </li> --}}

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'my-saved-jobs' ? 'active' : '' }}">
                <a href="{{ route('account.savedJob.index') }}" class="account-nav-link">
                    <i class="fas fa-briefcase"></i> My saved Jobs
                </a>
            </li>

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'my-applied-jobs' ? 'active' : '' }}">
                <a href="{{ route('account.appliedJob') }}" class="account-nav-link">
                    <i class="fas fa-briefcase"></i> My Applied Jobs
                </a>
            </li>

            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'edit-profile' ? 'active' : '' }}">
                <a href="{{ route('profile.edit') }}" class="account-nav-link">
                    <i class="fas fa-user-shield"></i> Edit Profile
                </a>
            </li>


            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'deactivate' ? 'active' : '' }}">
                <a href="{{ route('account.deactivate') }}" class="account-nav-link">
                    <i class="fas fa-folder-minus"></i> Deactivate Account
                </a>
            </li>

            <li class="list-group-item list-group-item-action {{ request()->segment(3) == 'upload-cv' ? 'active' : '' }}">
                <a href="{{ route('account.uploadCv') }}" class="account-nav-link">
                    <i class="fas fa-upload"></i> Upload CV
                </a>
            </li>
        @endrole

        <li
            class="list-group-item list-group-item-action {{ request()->segment(2) == 'change-password' ? 'active' : '' }}">
            <a href="{{ route('account.changePassword') }}" class="account-nav-link">
                <i class="fas fa-fingerprint"></i> Change Password
            </a>
        </li>

        @role('user')
            <li class="list-group-item list-group-item-action {{ request()->segment(1) == 'job-list' ? 'active' : '' }}">
                <a href="{{ route('job.index') }}" class="account-nav-link">
                    <i class="fas fa-clipboard-list"></i> Find Jobs
                </a>
            </li>
        @endrole

        @role('author')
            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'job-list' ? 'active' : '' }}">
                <a href="{{ route('author.viewAllJob') }}" class="account-nav-link">
                    <i class="fas fa-clipboard-list"></i> All Job List
                </a>
            </li>
        @endrole
    </ul>
</div>

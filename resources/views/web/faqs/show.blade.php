@extends('layouts.post')

@section('content')
    <div class="container">
        <h1>Cambridge InfoTech - Frequently Asked Questions</h1>
        <br>
        <br>
        <div class="row">
            <div class="col-md-3">
                <h5>Categories</h5>
                <br>
                <ul class="list-group">
                    @if (count($categories))
                        @foreach ($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('home.faqs.info', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- <li class="list-group-item">
                        <a href="#Cambrifdge infoTech-ai-ats">Cambrifdge infoTech AI ATS</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#types-of-job-post">Types of Job Post</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#recruitment-management-system">Recruitment Management System</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#about-Cambrifdge infoTech-employer">About Cambrifdge infoTech Employer</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#service-costs">Service Costs</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#online-payment">Online Payment</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#account-profile-registration">Account / Profile Registration</a>
                    </li>

                    <li class="list-group-item">
                        <a href="#support-service">Support Service</a>
                    </li> --}}
                </ul>
            </div>

            <div class="col-md-9">
                <div class="faq-section">
                    <h2 id="posting-updating-vacancies">{{ $checkFaqCategory->name }}</h2>
                    <ul class="list-unstyled">
                        <br>
                        @if ($checkFaqCategory->faqs->count() > 0)
                            @foreach ($checkFaqCategory->faqs as $faq)
                                <li>
                                    <strong>{{ $faq->question }}</strong>
                                    <br>
                                    {{ $faq->answer }}
                                </li>
                            @endforeach
                        @else
                            <span>Sorry! No Question / Answer Found.</span>
                        @endif
                        {{-- <li>
                            <strong>Can I view the entire resume from your database?</strong>
                            <br>
                            No, we don't provide database access to the employees for the confidentiality of information.
                            However, you can view resume for the applicants through vacancy posting at merojob. We protect
                            job seekers privacy until they are ready to engage with employers.
                        </li>
                        <li>
                            <strong>My IP address is blocked, how can I unblock it?</strong>
                            <br>
                            IP address will be blocked when you try to attempt login many times with wrong
                            username/password.. It will take 24 hours to automatically unblock it. If it is urgent to
                            unblock, you have to contact merojob office to unblock the IP address immediately.
                        </li>
                        <li>
                            <strong>For how long will my published job vacancy remain at Cambrifdge infoTech
                                website?</strong>
                            <br>
                            We have different job posting available like Top Jobs, Hot Jobs and Featured Jobs. For Top Jobs,
                            the vacancy can be posted for 3 days, 7 days and 15 days, depending on your need. Hot Jobs &
                            Featured Jobs, the vacancies can be published for 7 days or 15 days. However, the length of the
                            ad placement can be extended as per your need.
                        </li>
                        <li>
                            <strong>Is it possible to publish a job vacancy without disclosing my organization's
                                identity?</strong>
                            <br>
                            Yes, you can publish the job vacancy without disclosing the company's name but the company's
                            name has to be registered with merojob. The name of the company can be hidden but we suggest you
                            to show it for employers branding to get more applications.
                        </li>
                        <li>
                            <strong>How will the job seeker get to know about the job vacancy?</strong>
                            <br>
                            Your job posting will be accessible to all job seekers through our Website, other interface and
                            aggregator sites.
                        </li>
                        <li>
                            <strong>What is autoresponder? How does it work?</strong>
                            <br>
                            Auto responder is the customized auto response. Upon setting the auto responder, it is
                            automatically sent to applicant who applies for the advertised job vacancy.
                        </li>
                        <li>
                            <strong>What emails will Cambrifdge infoTech send me?</strong>
                            <br>
                            We send you emails based on the subscriptions you chose when you created your account. You may
                            also receive emails on Career Tips and Updates along with security alerts, account creation
                            confirmations, and warnings.
                        </li>
                        <li>
                            <strong>Is there any restriction on the number of resumes per vacancy?</strong>
                            <br>
                            No, there is no such restriction to the number of resume per vacancy.
                        </li>
                        <li>
                            <strong>How do I know my profile is 100% completed?</strong>
                            <br>
                            Profile completeness is shown in the percentage after you login to your account in your profile.
                        </li>
                        <li>
                            <strong>Will my posting appear on top of your page always?</strong>
                            <br>
                            No, latest posting will appear on top of the page as well as search result page.
                        </li>
                        <li>
                            <strong>When a job-seeker clicks on the Job title of the vacancy announced, where is s/he
                                redirected?</strong>
                            <br>
                            If a job seeker clicks on the job tittle, s/he will be redirected to your customized vacancy
                            announcement page with the job details.
                        </li> --}}
                    </ul>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .faq-section {
            margin-top: 20px;
        }

        .faq-section h2 {
            margin-top: 20px;
            color: #007bff;
        }

        .list-unstyled {
            padding-left: 0;
        }

        .list-unstyled li {
            margin-bottom: 15px;
        }
    </style>
@endpush

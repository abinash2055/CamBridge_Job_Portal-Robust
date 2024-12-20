@extends('layouts.account')

@section('content')
    <div class="container">
        <div class="account-layout border">
            <div class="account-hdr bg-primary text-white border">
                FAQ Details
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
                <br>
                <h2>{{ $faq->question }}</h2>
                <br>
                <p><strong>ANSWER:</strong></p>
                <p>{{ $faq->answer }}</p>
                <br>
                <p><strong>STATUS:</strong></p>
                <p> {{ $faq->status ? 'Active' : 'Inactive' }}</p>
                <br>
                <a href="{{ route('faqs.index', $faq->faq_category_id) }}" class="btn btn-warning btn-lg">Back to FAQs</a>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
@endsection

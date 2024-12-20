@extends('layouts.post')

@section('content')

    <div class="container my-5">
        <h1 class="text-center">Contact Us</h1>
        <br>
        <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error messages -->
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
            <div class="col-md-6">
                <div id="map" style="border: 1px solid #ccc;"></div>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8402.740373876712!2d85.32817919266282!3d27.68895607568405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19c4b587fead%3A0x5139863a542506c7!2sCambridge%20Infotech%20(Training%20Center)!5e0!3m2!1sen!2snp!4v1729164461701!5m2!1sen!2snp"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Leave Your Message</h3>
                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="inquiry-type">Select Inquiry Type:</label>
                        <select id="inquiry-type" class="form-control" name="inquiry_type" required>
                            <option value="General Enquiries">General Enquiries</option>
                            <option value="Public Feedback">Public Feedback</option>
                            <option value="Sales/Advertising Queries">Sales/Advertising Queries</option>
                            <option value="Website Error">Website Error</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" class="form-control" id="full-name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your message Here</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Google Maps script -->
    <script>
        function initMap() {
            const location = {
                lat: 27.68903,
                lng: 85.33563
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'New Baneshwor, Kathmandu, Nepal',
            });
        }
    </script>

@endsection

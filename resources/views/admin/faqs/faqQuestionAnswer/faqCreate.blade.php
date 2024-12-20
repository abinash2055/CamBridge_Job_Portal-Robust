@extends('layouts.account')

@section('content')
    <div class="container">
        <div class="account-layout border">
            <div class="account-hdr bg-primary text-white border">
                Create FAQ
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <br>
                    <label for="category_id" class="form-label .ml-1">Category</label>
                    <select name="faq_category_id" id="category_id" class="form-select custom-select" required
                        onchange="updateCategoryTitle()">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Display the selected category title -->
                <div class="mb-3" id="selected-category" style="display: none;">
                    <h3>Selected Category: <span id="category-title"></span></h3>
                </div>

                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <input type="text" name="question" id="question" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">Answer</label>
                    <textarea name="answer" id="answer" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select custom-select" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Create FAQ</button>
                <a href="{{ route('faqs.index', $categories->first()->id ?? 0) }}" class="btn btn-secondary">Back</a>
            </form>
            <br>
            <br>

        </div>
    </div>

    <script>
        function updateCategoryTitle() {
            const selectElement = document.getElementById('category_id');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const categoryTitleElement = document.getElementById('category-title');
            const selectedCategoryDiv = document.getElementById('selected-category');

            if (selectElement.value) {
                categoryTitleElement.textContent = selectedOption.text;
                selectedCategoryDiv.style.display = 'block'; // Show the title
            } else {
                categoryTitleElement.textContent = '';
                selectedCategoryDiv.style.display = 'none'; // Hide the title
            }
        }
    </script>

    <style>
        .custom-select {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            transition: border-color 0.2s;
        }

        .custom-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        option {
            padding: 10px;
        }
    </style>
@endsection

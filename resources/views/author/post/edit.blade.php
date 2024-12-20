 @extends('layouts.account')

 @section('content')
     <div class="container">
         <br>
         <h2 class="text-center">Edit Job</h2>

         @if (session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
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

         <form action="{{ route('author.post.update', $post->id) }}" method="POST">
             @csrf
             @method('PUT')

             <div class="form-group mb-3">
                 <label for="company_id" class="form-label text-primary">Company</label>
                 <select name="company_id" id="company_id" class="form-control bg-light text-dark border-primary" required>
                     @foreach ($companies as $company)
                         <option value="{{ $company->id }}" {{ $post->company_id == $company->id ? 'selected' : '' }}>
                             {{ $company->title }}
                         </option>
                     @endforeach
                 </select>
             </div>

             <div class="mb-3">
                 <label for="job_title" class="form-label" class="font-weight-bold">Job Title</label>
                 <input type="text" class="form-control" name="job_title" id="job_title" value="{{ $post->job_title }}"
                     required>
             </div>

             <div class="mb-3">
                 <label for="job_level" class="form-label" class="font-weight-bold">Job Level</label>
                 <select name="job_level" class="form-control" id="job_level" required>
                     <option value="" disabled {{ is_null($post->job_level) ? 'selected' : '' }}>Select Job Level
                     </option>
                     <option value="entry" {{ $post->job_level == 'entry' ? 'selected' : '' }}>Entry Level</option>
                     <option value="mid" {{ $post->job_level == 'mid' ? 'selected' : '' }}>Mid Level</option>
                     <option value="senior" {{ $post->job_level == 'senior' ? 'selected' : '' }}>Senior Level</option>
                     <option value="manager" {{ $post->job_level == 'manager' ? 'selected' : '' }}>Manager Level</option>
                     <option value="executive" {{ $post->job_level == 'executive' ? 'selected' : '' }}>Executive Level
                     </option>
                     <option value="other" {{ $post->job_level == 'other' ? 'selected' : '' }}>Other</option>
                 </select>
             </div>

             <div class="mb-3">
                 <label for="vacancy_count" class="form-label" class="font-weight-bold">Vacancy Count</label>
                 <input type="number" class="form-control" name="vacancy_count" id="vacancy_count"
                     value="{{ $post->vacancy_count }}" min="0" required>
             </div>


             <div class="mb-3">
                 <label for="employment_type" class="form-label" class="font-weight-bold">Employment Type</label>
                 <select name="employment_type" class="form-control" id="employment_type" required>
                     <option value="" disabled {{ is_null($post->employment_type) ? 'selected' : '' }}>Select
                         Employment Type</option>
                     <option value="Full-Time" {{ $post->employment_type == 'Full-Time' ? 'selected' : '' }}>Full-Time
                     </option>
                     <option value="Part-Time" {{ $post->employment_type == 'Part-Time' ? 'selected' : '' }}>Part-Time
                     </option>
                     <option value="Contract" {{ $post->employment_type == 'Contract' ? 'selected' : '' }}>Contract
                     </option>
                     <option value="Internship" {{ $post->employment_type == 'Internship' ? 'selected' : '' }}>Internship
                     </option>
                     <option value="Freelance" {{ $post->employment_type == 'Freelance' ? 'selected' : '' }}>Freelance
                     </option>
                     <option value="Temporary" {{ $post->employment_type == 'Temporary' ? 'selected' : '' }}>Temporary
                     </option>
                     <option value="Remote" {{ $post->employment_type == 'Remote' ? 'selected' : '' }}>Remote</option>
                 </select>
             </div>


             <div class="mb-3">
                 <label for="salary" class="form-label" class="font-weight-bold">Salary</label>
                 <input type="number" class="form-control" name="salary" id="salary" value="{{ $post->salary }}"
                     required>
             </div>

             <div class="mb-3">
                 <label for="job_location" class="form-label" class="font-weight-bold">Job Location</label>
                 <select name="job_location" class="form-control" id="job_location" required>
                     <option value="" disabled {{ is_null($post->job_location) ? 'selected' : '' }}>Select
                         JobLocation</option>
                     <option value="Achham" {{ $post->job_location == 'Achham' ? 'selected' : '' }}>Achham</option>
                     <option value="Arghakhanchi" {{ $post->job_location == 'Arghakhanchi' ? 'selected' : '' }}>
                         Arghakhanchi</option>
                     <option value="Baglung" {{ $post->job_location == 'Baglung' ? 'selected' : '' }}>Baglung</option>
                     <option value="Baitadi" {{ $post->job_location == 'Baitadi' ? 'selected' : '' }}>Baitadi</option>
                     <option value="Bajhang" {{ $post->job_location == 'Bajhang' ? 'selected' : '' }}>Bajhang</option>
                     <option value="Bajura" {{ $post->job_location == 'Bajura' ? 'selected' : '' }}>Bajura</option>
                     <option value="Banke" {{ $post->job_location == 'Banke' ? 'selected' : '' }}>Banke</option>
                     <option value="Bara" {{ $post->job_location == 'Bara' ? 'selected' : '' }}>Bara</option>
                     <option value="Bardiya" {{ $post->job_location == 'Bardiya' ? 'selected' : '' }}>Bardiya</option>
                     <option value="Bhaktapur" {{ $post->job_location == 'Bhaktapur' ? 'selected' : '' }}>Bhaktapur
                     </option>
                     <option value="Bhojpur" {{ $post->job_location == 'Bhojpur' ? 'selected' : '' }}>Bhojpur</option>
                     <option value="Chitwan" {{ $post->job_location == 'Chitwan' ? 'selected' : '' }}>Chitwan</option>
                     <option value="Dadeldhura" {{ $post->job_location == 'Dadeldhura' ? 'selected' : '' }}>Dadeldhura
                     </option>
                     <option value="Dailekh" {{ $post->job_location == 'Dailekh' ? 'selected' : '' }}>Dailekh</option>
                     <option value="Dang" {{ $post->job_location == 'Dang' ? 'selected' : '' }}>Dang</option>
                     <option value="Darchula" {{ $post->job_location == 'Darchula' ? 'selected' : '' }}>Darchula</option>
                     <option value="Dhading" {{ $post->job_location == 'Dhading' ? 'selected' : '' }}>Dhading</option>
                     <option value="Dhankuta" {{ $post->job_location == 'Dhankuta' ? 'selected' : '' }}>Dhankuta</option>
                     <option value="Dhanusha" {{ $post->job_location == 'Dhanusha' ? 'selected' : '' }}>Dhanusha</option>
                     <option value="Dolakha" {{ $post->job_location == 'Dolakha' ? 'selected' : '' }}>Dolakha</option>
                     <option value="Dolpa" {{ $post->job_location == 'Dolpa' ? 'selected' : '' }}>Dolpa</option>
                     <option value="Doti" {{ $post->job_location == 'Doti' ? 'selected' : '' }}>Doti</option>
                     <option value="Eastern Rukum" {{ $post->job_location == 'Eastern Rukum' ? 'selected' : '' }}>Eastern
                         Rukum</option>
                     <option value="Gorkha" {{ $post->job_location == 'Gorkha' ? 'selected' : '' }}>Gorkha</option>
                     <option value="Gulmi" {{ $post->job_location == 'Gulmi' ? 'selected' : '' }}>Gulmi</option>
                     <option value="Humla" {{ $post->job_location == 'Humla' ? 'selected' : '' }}>Humla</option>
                     <option value="Ilam" {{ $post->job_location == 'Ilam' ? 'selected' : '' }}>Ilam</option>
                     <option value="Jajarkot" {{ $post->job_location == 'Jajarkot' ? 'selected' : '' }}>Jajarkot</option>
                     <option value="Jhapa" {{ $post->job_location == 'Jhapa' ? 'selected' : '' }}>Jhapa</option>
                     <option value="Jumla" {{ $post->job_location == 'Jumla' ? 'selected' : '' }}>Jumla</option>
                     <option value="Kailali" {{ $post->job_location == 'Kailali' ? 'selected' : '' }}>Kailali</option>
                     <option value="Kalikot" {{ $post->job_location == 'Kalikot' ? 'selected' : '' }}>Kalikot</option>
                     <option value="Kanchanpur" {{ $post->job_location == 'Kanchanpur' ? 'selected' : '' }}>Kanchanpur
                     </option>
                     <option value="Kapilvastu" {{ $post->job_location == 'Kapilvastu' ? 'selected' : '' }}>Kapilvastu
                     </option>
                     <option value="Kaski" {{ $post->job_location == 'Kaski' ? 'selected' : '' }}>Kaski</option>
                     <option value="Kathmandu" {{ $post->job_location == 'Kathmandu' ? 'selected' : '' }}>Kathmandu
                     </option>
                     <option value="Kavrepalanchok" {{ $post->job_location == 'Kavrepalanchok' ? 'selected' : '' }}>
                         Kavrepalanchok</option>
                     <option value="Khotang" {{ $post->job_location == 'Khotang' ? 'selected' : '' }}>Khotang</option>
                     <option value="Lalitpur" {{ $post->job_location == 'Lalitpur' ? 'selected' : '' }}>Lalitpur</option>
                     <option value="Lamjung" {{ $post->job_location == 'Lamjung' ? 'selected' : '' }}>Lamjung</option>
                     <option value="Mahottari" {{ $post->job_location == 'Mahottari' ? 'selected' : '' }}>Mahottari
                     </option>
                     <option value="Makwanpur" {{ $post->job_location == 'Makwanpur' ? 'selected' : '' }}>Makwanpur
                     </option>
                     <option value="Manang" {{ $post->job_location == 'Manang' ? 'selected' : '' }}>Manang</option>
                     <option value="Morang" {{ $post->job_location == 'Morang' ? 'selected' : '' }}>Morang</option>
                     <option value="Mugu" {{ $post->job_location == 'Mugu' ? 'selected' : '' }}>Mugu</option>
                     <option value="Mustang" {{ $post->job_location == 'Mustang' ? 'selected' : '' }}>Mustang</option>
                     <option value="Myagdi" {{ $post->job_location == 'Myagdi' ? 'selected' : '' }}>Myagdi</option>
                     <option value="Nawalpur" {{ $post->job_location == 'Nawalpur' ? 'selected' : '' }}>Nawalpur</option>
                     <option value="Nuwakot" {{ $post->job_location == 'Nuwakot' ? 'selected' : '' }}>Nuwakot</option>
                     <option value="Okhaldhunga" {{ $post->job_location == 'Okhaldhunga' ? 'selected' : '' }}>Okhaldhunga
                     </option>
                     <option value="Palpa" {{ $post->job_location == 'Palpa' ? 'selected' : '' }}>Palpa</option>
                     <option value="Panchthar" {{ $post->job_location == 'Panchthar' ? 'selected' : '' }}>Panchthar
                     </option>
                     <option value="Parasi" {{ $post->job_location == 'Parasi' ? 'selected' : '' }}>Parasi</option>
                     <option value="Parbat" {{ $post->job_location == 'Parbat' ? 'selected' : '' }}>Parbat</option>
                     <option value="Parsa" {{ $post->job_location == 'Parsa' ? 'selected' : '' }}>Parsa</option>
                     <option value="Pyuthan" {{ $post->job_location == 'Pyuthan' ? 'selected' : '' }}>Pyuthan</option>
                     <option value="Ramechhap" {{ $post->job_location == 'Ramechhap' ? 'selected' : '' }}>Ramechhap
                     </option>
                     <option value="Rasuwa" {{ $post->job_location == 'Rasuwa' ? 'selected' : '' }}>Rasuwa</option>
                     <option value="Rautahat" {{ $post->job_location == 'Rautahat' ? 'selected' : '' }}>Rautahat</option>
                     <option value="Rolpa" {{ $post->job_location == 'Rolpa' ? 'selected' : '' }}>Rolpa</option>
                     <option value="Rupandehi" {{ $post->job_location == 'Rupandehi' ? 'selected' : '' }}>Rupandehi
                     </option>
                     <option value="Salyan" {{ $post->job_location == 'Salyan' ? 'selected' : '' }}>Salyan</option>
                     <option value="Sankhuwasabha" {{ $post->job_location == 'Sankhuwasabha' ? 'selected' : '' }}>
                         Sankhuwasabha</option>
                     <option value="Saptari" {{ $post->job_location == 'Saptari' ? 'selected' : '' }}>Saptari</option>
                     <option value="Sarlahi" {{ $post->job_location == 'Sarlahi' ? 'selected' : '' }}>Sarlahi</option>
                     <option value="Sindhuli" {{ $post->job_location == 'Sindhuli' ? 'selected' : '' }}>Sindhuli</option>
                     <option value="Sindhupalchok" {{ $post->job_location == 'Sindhupalchok' ? 'selected' : '' }}>
                         Sindhupalchok</option>
                     <option value="Siraha" {{ $post->job_location == 'Siraha' ? 'selected' : '' }}>Siraha</option>
                     <option value="Solukhumbu" {{ $post->job_location == 'Solukhumbu' ? 'selected' : '' }}>Solukhumbu
                     </option>
                     <option value="Sunsari" {{ $post->job_location == 'Sunsari' ? 'selected' : '' }}>Sunsari</option>
                     <option value="Surkhet" {{ $post->job_location == 'Surkhet' ? 'selected' : '' }}>Surkhet</option>
                     <option value="Syangja" {{ $post->job_location == 'Syangja' ? 'selected' : '' }}>Syangja</option>
                     <option value="Tanahun" {{ $post->job_location == 'Tanahun' ? 'selected' : '' }}>Tanahun</option>
                     <option value="Taplejung" {{ $post->job_location == 'Taplejung' ? 'selected' : '' }}>Taplejung
                     </option>
                     <option value="Terhathum" {{ $post->job_location == 'Terhathum' ? 'selected' : '' }}>Terhathum
                     </option>
                     <option value="Udayapur" {{ $post->job_location == 'Udayapur' ? 'selected' : '' }}>Udayapur</option>
                     <option value="Western Rukum" {{ $post->job_location == 'Western Rukum' ? 'selected' : '' }}>
                         WesternRukum</option>
                     <option value="Other" {{ $post->job_location == 'Other' ? 'selected' : '' }}>Other</option>
                 </select>
             </div>


             <div class="mb-3">
                 <label for="deadline" class="form-label" class="font-weight-bold">Deadline</label>
                 <input type="date" class="form-control" name="deadline" id="deadline"
                     value="{{ \Carbon\Carbon::parse($post->deadline)->format('Y-m-d') }}" required>
             </div>

             <div class="mb-3">
                 <label for="education_level" class="form-label" class="font-weight-bold">Education Level</label>
                 <select name="education_level" class="form-control" id="education_level" required>
                     <option value="" disabled {{ is_null($post->education_level) ? 'selected' : '' }}>Select
                         Education Level</option>
                     <option value="Bachelors" {{ $post->education_level == 'Bachelors' ? 'selected' : '' }}>Bachelors
                     </option>
                     <option value="High School" {{ $post->education_level == 'High School' ? 'selected' : '' }}>High
                         School</option>
                     <option value="Master" {{ $post->education_level == 'Master' ? 'selected' : '' }}>Master</option>
                     <option value="SEE Mid School" {{ $post->education_level == 'SEE Mid School' ? 'selected' : '' }}>
                         SEE Mid School</option>
                     <option value="Other" {{ $post->education_level == 'Other' ? 'selected' : '' }}>Other</option>
                 </select>
             </div>


             <div class="mb-3">
                 <label for="experience" class="form-label" class="font-weight-bold">Experience Level</label>
                 <select name="experience" class="form-control" id="experience" required>
                     <option value="" disabled {{ is_null($post->experience) ? 'selected' : '' }}>Select Experience
                         Level</option>
                     <option value="Fresher" {{ $post->experience == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                     <option value="1-2 years" {{ $post->experience == '1-2 years' ? 'selected' : '' }}>1-2 Years
                     </option>
                     <option value="3-5 years" {{ $post->experience == '3-5 years' ? 'selected' : '' }}>3-5 Years
                     </option>
                     <option value="5+ years" {{ $post->experience == '5+ years' ? 'selected' : '' }}>5+ Years</option>
                 </select>
             </div>

             <div class="mb-3">
                 <label for="skills" class="form-label" class="font-weight-bold">Professional Skills</label>
                 <div id="skills-container">
                     @php
                         $skills = explode(',', $post->skills);
                     @endphp

                     @foreach ($skills as $skill)
                         <div class="input-group mb-2 skill-input">
                             <input type="text" class="form-control" name="skills[]" value="{{ trim($skill) }}"
                                 required>
                             <button type="button" class="btn btn-danger remove-skill">Remove</button>
                         </div>
                     @endforeach
                 </div>
                 <button type="button" class="btn btn-success" id="add-skill">Add Skills</button>
             </div>

             {{-- <div class="mb-3">
                 <label for="specifications" class="form-label">Specifications</label>
                 <input type="text" id="specifications" name="specifications" value="{{ $post->specifications }}">
                 <div id="quillEditor" style="height:200px"></div>
             </div> --}}

             <div class="mb-3">
                 <label for="specifications" class="form-label" class="font-weight-bold">Specifications</label>
                 <textarea id="specifications" name="specifications" class="form-control">{{ $post->specifications }}</textarea>
             </div>

             {{-- <div class="form-group mb-3">
                 <label for="status" class="form-label text-success" class="font-weight-bold">Status</label>
                 <select name="status" id="status" class="form-control bg-info  text-dark border-success" required>
                     <option value="active" {{ $post->status == 'active' ? 'selected' : '' }}>Active</option>
                     <option value="inactive" {{ $post->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                 </select>
             </div> --}}

             <button type="submit" class="btn btn-primary">Update Job Post</button>
         </form>
     </div>
 @endsection

 @push('css')
     <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
     {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css">  --}}
 @endpush

 @push('js')
     <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script> --}}
     {{-- <script>
         $(document).ready(function() {
             var quill = new Quill('#quillEditor', {
                 modules: {
                     toolbar: [
                         [{
                             'font': []
                         }, {
                             'size': []
                         }],
                         ['bold', 'italic'],
                         [{
                             list: 'ordered'
                         }, {
                             list: 'bullet'
                         }],
                         ['link', 'blockquote', 'code-block', 'image'],
                     ]
                 },
                 placeholder: 'Job Reqirement , Job Specifications etc ...',
                 theme: 'snow'
             });


             const postBtn = document.querySelector('#postBtn');
             const postForm = document.querySelector('#postForm');
             const specifications = document.querySelector('#specifications');

             if (specifications.value) {
                 quill.root.innerHTML = specifications.value;
             }

             postBtn.addEventListener('click', function(e) {
                 e.preventDefault();
                 specifications.value = quill.root.innerHTML

                 postForm.submit();
             })
         })

         // summerNote
         $(document).ready(function() {
        $('#specifications').summernote({
            height: 200, 
            placeholder: 'Enter job specifications...',
            tabsize: 2
        });
    })
     </script> --}}

     <!-- For Skills -->
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const skillsContainer = document.getElementById('skills-container');
             const addSkillButton = document.getElementById('add-skill');

             function addSkillInput() {
                 const skillInputDiv = document.createElement('div');
                 skillInputDiv.className = 'input-group mb-2 skill-input';

                 // Create input and button elements separately
                 const skillInput = document.createElement('input');
                 skillInput.type = 'text';
                 skillInput.className = 'form-control';
                 skillInput.name = 'skills[]'; // Name as an array to allow multiple skills
                 // Do not set 'required' attribute

                 const removeButton = document.createElement('button');
                 removeButton.type = 'button';
                 removeButton.className = 'btn btn-danger remove-skill';
                 removeButton.textContent = 'Remove';

                 // Append input and button to the skillInputDiv
                 skillInputDiv.appendChild(skillInput);
                 skillInputDiv.appendChild(removeButton);

                 // Append skillInputDiv to the skillsContainer
                 skillsContainer.appendChild(skillInputDiv);

                 // Add event listener to the remove button
                 removeButton.addEventListener('click', removeSkillInput);
             }

             function removeSkillInput(event) {
                 const skillInputDiv = event.target.parentElement;
                 skillsContainer.removeChild(skillInputDiv);
             }

             if (addSkillButton) {
                 addSkillButton.addEventListener('click', addSkillInput);
             }

             // Add listeners to existing remove buttons (if any)
             const removeButtons = document.querySelectorAll('.remove-skill');
             removeButtons.forEach(button => {
                 button.addEventListener('click', removeSkillInput);
             });
         });
     </script>
 @endpush

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminCompanyController extends Controller
// {
//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create($id)
//     {
//         // Company for user id
//         if (Company::where('user_id', $id)->first()) {

//             Alert::toast('You already have a company!', 'info');
//             return $this->edit($id);
//         } else {
//             $categories = CompanyCategory::all();

//             return view('admin.company.create', compact('categories'));
//         }
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request, $id)
//     {
//         $this->validateCompany($request);

//         $company = new Company();

//         if ($this->companySave($company, $request, $id)) {

//             Alert::toast('Company created! Now you can add posts.', 'success');

//             return redirect()->route('admin.dashboard');
//         }

//         Alert::toast('Failed!', 'error');

//         return redirect()->route('admin.dashboard');

//         $company = Company::where('user_id', $id)->firstOrFail();

//         //edited
//         if ($company) {

//             Alert::toast('You already have a company!', 'info');

//             return redirect()->route('admin.company.edit');
//         }

//         $categories = CompanyCategory::all();

//         return view('admin.company.create', compact('categories'));
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id) // {{ request()->route('id') }}
//     {
//         $company = Company::where('user_id', $id)->firstOrFail();
//         $categories = CompanyCategory::all();

//         return view('admin.company.edit', compact('company', 'categories'));

//         // edited 
//         if (!$company) {
//             return redirect()->route('admin.company.create', ['id' => $id]);
//         }

//         $categories = CompanyCategory::all();
//         return view('admin.company.edit', compact('company', 'categories'));
//     }



//     public function update(Request $request, $id)
//     {
//         $this->validateCompanyUpdate($request);

//         $company = Company::where('user_id', $id)->firstOrFail();

//         if ($this->companyUpdate($company, $request, $id)) {

//             Alert::toast('Company updated!', 'success');

//             return redirect()->route('admin.dashboard');
//         }

//         Alert::toast('Failed!', 'error');

//         return redirect()->route('admin.dashboard');
//     }

//     protected function validateCompany(Request $request)
//     {
//         return $request->validate([
//             'title' => 'required|min:5',
//             'description' => 'required|min:5',
//             'logo' => 'required|image|max:2999',
//             'category' => 'required',
//             'website' => 'required|string',
//             'cover_img' => 'sometimes|image|max:3999'
//         ]);
//     }

//     protected function validateCompanyUpdate(Request $request)
//     {
//         return $request->validate([
//             'title' => 'required|min:5',
//             'description' => 'required|min:5',
//             'logo' => 'sometimes|image|max:2999',
//             'category' => 'required',
//             'website' => 'required|string',
//             'cover_img' => 'sometimes|image|max:3999'
//         ]);
//     }

//     protected function companySave(Company $company, Request $request, $id)
//     {
//         $company->user_id = $id;
//         $company->title = $request->title;
//         $company->description = $request->description;
//         $company->company_category_id = $request->category;
//         $company->website = $request->website;

//         //logo
//         $fileNameToStore = $this->getFileName($request->file('logo'));
//         $logoPath = $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);

//         if ($company->logo) {
//             Storage::delete('public/companies/logos/' . basename($company->logo));
//         }

//         $company->logo = 'storage/companies/logos/' . $fileNameToStore;

//         //cover image 
//         if ($request->hasFile('cover_img')) {
//             $fileNameToStore = $this->getFileName($request->file('cover_img'));
//             $coverPath = $request->file('cover_img')->storeAs('public/companies/cover', $fileNameToStore);

//             if ($company->cover_img) {
//                 Storage::delete('public/companies/cover/' . basename($company->cover_img));
//             }

//             $company->cover_img = 'storage/companies/cover/' . $fileNameToStore;
//         } else {
//             $company->cover_img = 'nocover';
//         }

//         if ($company->save()) {
//             return true;
//         }
//         return false;
//     }

//     protected function companyUpdate(Company $company, Request $request, $id)
//     {
//         $company->user_id = $id;
//         $company->title = $request->title;
//         $company->description = $request->description;
//         $company->company_category_id = $request->category;
//         $company->website = $request->website;

//         //logo should exist but still checking for the name
//         if ($request->hasFile('logo')) {
//             $fileNameToStore = $this->getFileName($request->file('logo'));
//             $logoPath = $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);

//             if ($company->logo) {
//                 Storage::delete('public/companies/logos/' . basename($company->logo));
//             }

//             $company->logo = 'storage/companies/logos/' . $fileNameToStore;
//         }

//         //cover image 
//         if ($request->hasFile('cover_img')) {
//             $fileNameToStore = $this->getFileName($request->file('cover_img'));
//             $coverPath = $request->file('cover_img')->storeAs('public/companies/cover', $fileNameToStore);

//             if ($company->cover_img) {
//                 Storage::delete('public/companies/cover/' . basename($company->cover_img));
//             }

//             $company->cover_img = 'storage/companies/cover/' . $fileNameToStore;
//         }
//         if ($company->save()) {
//             return true;
//         }
//         return false;
//     }

//     protected function getFileName($file)
//     {
//         $fileName = $file->getClientOriginalName();
//         $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
//         $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

//         return $actualFileName . time() . '.' . $fileExtension;
//     }

//     public function destroy($id)
//     {
//         $company = Company::where('user_id', $id)->firstOrFail();

//         Storage::delete('public/companies/logos/' . basename($company->logo));

//         if ($company->delete()) {

//             return redirect()->route('admin.dashboard');
//         }

//         return redirect()->route('admin.dashboard');
//     }
// }

{
    public function create($id)
    {
        if (Company::where('user_id', $id)->exists()) {
            Alert::toast('You already have a company!', 'info');
            return redirect()->route('admin.company.edit', $id);
        }

        $categories = CompanyCategory::all();
        return view('admin.company.create', compact('categories', 'id'));
    }

    public function store(
        Request $request,
        $id
    ) {
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'logo' => 'required|image|max:2999',
            'category' => 'required',
            'website' => 'required|string',
            'cover_img' => 'nullable|image|max:3999',
        ]);

        $company = new Company();
        $company->user_id = $id;
        $company->title = $request->title;
        $company->description = $request->description;
        $company->company_category_id = $request->category;
        $company->website = $request->website;

        // Save logo
        if ($request->hasFile('logo')) {
            $fileNameToStore = $this->generateFileName($request->file('logo'));
            $logoPath = $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);
            $company->logo = 'storage/companies/logos/' . $fileNameToStore;
        }

        // Save cover image
        if ($request->hasFile('cover_img')) {
            $fileNameToStore = $this->generateFileName($request->file('cover_img'));
            $coverPath = $request->file('cover_img')->storeAs('public/companies/cover', $fileNameToStore);
            $company->cover_img = 'storage/companies/cover/' . $fileNameToStore;
        } else {
            $company->cover_img = 'nocover';
        }

        if ($company->save()) {
            Alert::toast('Company created successfully!', 'success');
            return redirect()->route('admin.dashboard');
        }

        Alert::toast('Failed to create the company!', 'error');
        return back();
    }

    public function edit($id)
    {
        $company = Company::where('user_id', $id)->firstOrFail();
        $categories = CompanyCategory::all();

        return view('admin.company.edit', compact('company', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'logo' => 'nullable|image|max:2999',
            'category' => 'required',
            'website' => 'required|string',
            'cover_img' => 'nullable|image|max:3999',
        ]);

        $company = Company::where('user_id', $id)->firstOrFail();

        $company->title = $request->title;
        $company->description = $request->description;
        $company->company_category_id = $request->category;
        $company->website = $request->website;

        // Update logo
        if ($request->hasFile('logo')) {
            $fileNameToStore = $this->generateFileName($request->file('logo'));
            $logoPath = $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);

            // Delete old logo if exists
            if ($company->logo) {
                Storage::delete('public/companies/logos/' . basename($company->logo));
            }

            $company->logo = 'storage/companies/logos/' . $fileNameToStore;
        }

        // Update cover image
        if ($request->hasFile('cover_img')) {
            $fileNameToStore = $this->generateFileName($request->file('cover_img'));
            $coverPath = $request->file('cover_img')->storeAs('public/companies/cover', $fileNameToStore);

            // Delete old cover image if exists
            if ($company->cover_img) {
                Storage::delete('public/companies/cover/' . basename($company->cover_img));
            }

            $company->cover_img = 'storage/companies/cover/' . $fileNameToStore;
        }

        if ($company->save()) {
            Alert::toast('Company updated successfully!', 'success');
            return redirect()->route('admin.dashboard');
        }

        Alert::toast('Failed to update the company!', 'error');
        return back();
    }

    private function generateFileName($file)
    {
        $fileExtension = $file->getClientOriginalExtension();
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $fileExtension;
    }
}

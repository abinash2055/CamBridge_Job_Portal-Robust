<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminCompanyCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:5'
        ]);

        CompanyCategory::create([
            'category_name' => $request->category_name
        ]);

        Alert::toast('Category Created!', 'success');
        return redirect()->route('admin.dashboard');
    }

    public function edit(CompanyCategory $category)
    {
        return view('admin.companyCategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:5'
        ]);

        $category = CompanyCategory::find($id);

        $category->update([
            'category_name' => $request->category_name
        ]);

        Alert::toast('Category Updated!', 'success');

        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        $category = CompanyCategory::find($id);
        $category->delete();

        Alert::toast('Category Delete!', 'success');

        return redirect()->route('admin.dashboard');
    }
}

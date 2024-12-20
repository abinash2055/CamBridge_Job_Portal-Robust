<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Post;
use App\Models\CompanyCategory;

class AdminFaqController extends Controller
{
    // Display a list of FAQs for a specific category
    public function index($categoryId)
    {
        $userCount = User::count();
        $jobCount = Post::count();
        $authorCount = User::where('role', 'author')->count();
        $liveJobCount = Post::where('status', 'live')->count();
        $jobCategoriesCount = CompanyCategory::count();

        $faqs = Faq::where('faq_category_id', $categoryId)->get();
        $categories = FaqCategory::findOrFail($categoryId);

        if (!$categories) {

            Alert::Toast('Category not found.', 'error');

            return redirect()->route('faqs.index');
        }

        $faqs = Faq::where('faq_category_id', $categoryId)->get();

        return view('admin.faqs.faqQuestionAnswer.faqIndex', compact('faqs', 'categories', 'userCount', 'jobCount', 'authorCount', 'liveJobCount', 'jobCategoriesCount'));
    }

    // Show the form for creating a new FAQ
    public function create($categoryId)
    {
        $categories = FaqCategory::all();

        return view('admin.faqs.faqQuestionAnswer.faqCreate', compact('categories'));
    }

    // Store a newly created FAQ in the database
    public function store(Request $request)
    {
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Faq::create($request->all());

        Alert::Toast('FAQ created successfully.', 'success');

        return redirect()->route('faqs.index', $request->faq_category_id);
    }

    // Show the form for editing the specified FAQ
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = FaqCategory::all();

        return view('admin.faqs.faqQuestionAnswer.faqEdit', compact('faq', 'categories'));
    }

    // Update the specified FAQ in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        Alert::Toast('FAQ updated successfully.', 'success');

        return redirect()->route('faqs.index', $faq->faq_category_id);
    }

    public function showFaqIndex()
    {
        $userCount = User::count();
        $faqs = Faq::all();

        return view('admin.faqs.faqQuestionAnswer.faqIndex', [
            'userCount' => $userCount,
            'faqs' => $faqs
        ]);
    }

    // Remove the specified FAQ from the database
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $categoryId = $faq->faq_category_id;
        $faq->delete();

        Alert::Toast('FAQ deleted successfully.', 'success');

        return redirect()->route('faqs.index', $categoryId);
    }

    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.faqQuestionAnswer.faqShow', compact('faq'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Disclosure;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\Support;
use App\Models\User;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class AppManagementController extends Controller
{
    public function PrivacyPolicy()
    {
        $policy =  PrivacyPolicy::all();
        return view('pages.privacy_policy', compact('policy'));
    }
    public function PrivacyPolicyCreate()
    {
        return view('pages.privacy_policy_create');
    }
    public function PrivacyPolicyStore(Request $request)
    {
        $policy = new PrivacyPolicy();
        $policy->title        =  $request->name;
        $policy->description  =  $request->description;

        $policy->save();
        return redirect()->back()->with(['success' => 'Successfully added a new Privacy Policy!']);
    }

    public function PrivacyPolicyEdit(Request $request, $id)
    {
        $policyedit = PrivacyPolicy::find($id);
        return view('pages.privacy_policy_edit', compact('policyedit'));
    }
    public function PrivacyPolicyEditStore(Request $request, $id)
    {
        $policyedit = PrivacyPolicy::find($id);
        $policyedit->title        =  $request->name;
        $policyedit->description  =  $request->description;
        $policyedit->update();
        return view('pages.privacy_policy_edit', compact('policyedit'));
    }
    public function  PrivacyPolicyDelete($id)
    {
        $policydel = PrivacyPolicy::find($id);
        $policydel->delete();
        return redirect()->back()->with('success', 'Successfully, Privacy Policy was deleted!');
    }

    public function Disclosure()
    {
        $disclo = Disclosure::all();
        return view('pages.disclosure', compact('disclo'));
    }

    public function DisclosureCreate()
    {
        return view('pages.disclosure_create');
    }
    public function DisclosureCreateStore(Request $request)
    {
        $disclo = new Disclosure();
        $disclo->title        =  $request->name;
        $disclo->description  =  $request->description;
        $disclo->save();
        return redirect()->back()->with('success', 'Successfully, New Disclosure was added!');
    }
    public function DisclosureEdit($id)
    {
        $discloed = Disclosure::find($id);
        return view('pages.disclosure_edit', compact('discloed'));
    }
    public function DisclosureEditStore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $disclosure = Disclosure::find($id);
        if ($disclosure) {
            // Update the disclosure's properties
            $disclosure->title = $request->name;
            $disclosure->description = $request->description;
            $disclosure->update();
            return redirect()->back()->with('success', 'Disclosure updated successfully!');
        }
        return redirect()->back()->with('error', 'Disclosure not found.');
    }
    public function DisclosureDelete($id)
    {
        $disclo = Disclosure::find();
        $disclo->delete();
        return redirect()->back()->with('success', 'Successfully, Disclosure was deleted!');
    }

    public function WhyChooseUs()
    {
        $whychoose = WhyChooseUs::all();
        return view('pages.whychooseus', compact('whychoose'));
    }
    public function WhyChooseUsEdit($id)
    {
        $whychoosedit = WhyChooseUs::find($id);
        return view('pages.whychooseus_edit', compact('whychoosedit'));
    }
    public function WhyChooseUsEditStore(Request $request, $id)
    {
        $whychoosedit = WhyChooseUs::find($id);
        $whychoosedit->title       = $request->name;
        $whychoosedit->description = $request->description;
        return view('pages.whychooseus_edit', compact('whychoosedit'));
    }
    public function WhyChooseUsCreate()
    {
        return view('pages.whychooseus_create');
    }
    public function WhyChooseUsCreateStore(Request $request)
    {
        $whychooseus = new WhyChooseUs();
        $whychooseus->title        =  $request->name;
        $whychooseus->description  =  $request->description;
        $whychooseus->save();
        return redirect()->back()->with('success', 'Succesfully, Why Choose Us was added');
    }
    public function WhyChooseUsDelete($id)
    {
        $whychooseus = WhyChooseUs::find($id);
        $whychooseus->delete();
        return redirect()->back()->with('success', 'Succesfully, Item was deleted!');
    }

    public function Faq()
    {
        $faq = Faq::all();
        return view('pages.faq', compact('faq'));
    }
    public function FaqCreate(Request $request)
    {
        return view('pages.faq_create');
    }
    public function FaqCreateStore(Request $request)
    {
        $faqadd = new Faq();
        $faqadd->title       = $request->name;
        $faqadd->description = $request->description;
        $faqadd->save();
        return view('pages.faq_create', compact('faqadd'));
    }
    public function FaqEdit($id)
    {
        $faqedit = Faq::find($id);
        return view('pages.faq_edit', compact('faqedit'));
    }
    public function FaqEditStore(Request $request, $id)
    {
        $faqedit = Faq::find($id);
        $faqedit->title       = $request->name;
        $faqedit->description = $request->description;
        $faqedit->update();
        return redirect()->back()->with('success', 'Successfully, FAQ was updated!');
    }
    public function FaqDelete($id)
    {
        $faqdel = Faq::find($id);
        $faqdel->delete();
        return redirect()->back()->with('success', 'Successfully, FAQ was deleted!');
    }

    public function AboutUs()
    {
        $about = AboutUs::all();
        return view('pages.about_us', compact('about'));
    }
    public function AboutUsCreate(Request $request)
    {
        return view('pages.about_us_create');
    }
    public function AboutUsCreateStore(Request $request)
    {
        $aboutcreat = new AboutUs();
        $aboutcreat->title       = $request->name;
        $aboutcreat->description = $request->description;
        return view('pages.about_us_create');
    }
    public function AboutUsEdit($id)
    {
        $aboutedt = AboutUs::find($id);
        return view('pages.about_us_edit', compact('aboutedt'));
    }

    public function AboutUsEditStore(Request $request, $id)
    {
        $aboutedit = AboutUs::find($id);
        $aboutedit->title       = $request->name;
        $aboutedit->description = $request->description;
        return view('pages.about_us_edit');
    }
    public function AboutUsDelete($id)
    {
        $aboutdel = AboutUs::find($id);
        $aboutdel->delete();
        return redirect()->back()->with('success', 'Successfully, FAQ was deleted!');
    }

    public function Support()
    {
        $support = Support::all();
        return view('pages.support', compact('support'));
    }
    public function SupportCreate()
    {
        return view('pages.support_create');
    }
    public function SupportCreateStore(Request $request)
    {
        $support   =  new Support();
        $support->support_phone    = $request->supportPhone;
        $support->support_email    = $request->supportEmail;
        $support->save();
        return redirect()->back()->with('success', 'Successfully, Support was deleted!');
    }
    public function SupportEdit($id)
    {
        $supportedt  = Support::findOrFail($id);
        return view('pages.support_edit', compact('supportedt'));
    }
    public function SupportEditStore(Request $request, $id)
    {
        $support  = Support::findOrFail($id);
        $support->support_phone   = $request->supportPhone;
        $support->support_email   = $request->supportEmail;
        $support->update();
        return redirect()->back()->with('message', 'Successfully, Support was edited!');
    }
    public function SupportDelete($id)
    {
        $supportedt  = Support::findOrFail($id);
        $supportedt->delete();
        return redirect()->back()->with('me', 'Successfully, Support was deleted!');
    }
}

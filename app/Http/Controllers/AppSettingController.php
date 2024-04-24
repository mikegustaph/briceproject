<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Disclosure;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\Support;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function policy()
    {
        $privacys = PrivacyPolicy::all();
        return view('pages.app_privacy', compact('privacys'));
    }
    public function policyCreate()
    {
        return view('pages.app_privacy_new');
    }
    public function policyCreateStore(Request $request)
    {
        $disclosure = new PrivacyPolicy();
        $disclosure->create_by    =  $request->user;
        $disclosure->title        =  $request->name;
        $disclosure->content      =  $request->privacytext;
        $disclosure->save();
        return redirect()->back()->with(["success" => "Successfully added a new Privacy Policy!"]);
    }
    public function policyEdit($id)
    {
        $policy = PrivacyPolicy::find($id);
        return view('pages.app_privacy_edit', compact('policy'));
    }

    public function policyEditStore(Request $request, $id)
    {
        $policy = PrivacyPolicy::find($id);
        $policy->create_by    =  $request->user;
        $policy->title        =  $request->name;
        $policy->content      =  $request->privacytext;
        $policy->update();
        return redirect()->back()->with('success', 'Successfully update Privacy Policy!');
    }
    public function disclosure()
    {
        $disclosures = Disclosure::all();
        return view('pages.app_disclosure', compact('disclosures'));
    }
    public function disclosureData(Request $request)
    {
        $disclosure = new Disclosure();
        $disclosure->created_by      =  $request->user;
        $disclosure->name            =  $request->name;
        $disclosure->disclosure_text =  $request->disclosuretext;
        $disclosure->save();
        return redirect()->back()->with(["success" => "Successfully added a new disclosure!"]);
    }
    public function disclosureCreate()
    {
        return view('pages.app_disclosure_create');
    }
    public function disclosureUpdate()
    {
        return view('pages.app_disclosure_create');
    }
    public function disclosureEdit($id)
    {
        $disclosure = Disclosure::find($id);
        return view('pages.app_disclosure_edit', compact('disclosure'));
    }

    public function disclosureEditUpdate(Request $request, $id)
    {
        $disclosureupd = Disclosure::find($id);
        $disclosureupd->name            = $request->name;
        $disclosureupd->disclosure_text = $request->disclosuretext;
        $disclosureupd->update();
        return redirect()->back()->with('success', 'Successfully update disclosure!');
    }

    public function disclosureDelete()
    {

        return view('pages.app_disclosure_create');
    }

    public function whychoose_us()
    {
        $result = WhyChooseUs::all();
        return view('pages.app_whychoose', compact('result'));
    }
    public function whychooseCreate()
    {
        //$result = WhyChooseUs::all();
        return view('pages.app_whychoose_create');
    }
    public function whychooseStore(Request $request)
    {
        $whychoose = new WhyChooseUs();
        $whychoose->created_by     =  $request->user;
        $whychoose->title          =  $request->title;
        $whychoose->interest_rate  =  $request->intratext;
        $whychoose->service_charge =  $request->servCharge;
        $whychoose->save();
        return redirect()->back()->with('success', 'Successfully add new data!');
    }
    public function whychooseEdit($id)
    {
        $result = WhyChooseUs::find($id);
        return view('pages.app_whychoose_edit', compact('result'));
    }

    public function whychooseEditStore(Request $request)
    {
        $whychoose = new  WhyChooseUs();
        $whychoose->created_by     =  $request->user;
        $whychoose->title          =  $request->title;
        $whychoose->interest_rate  =  $request->intratext;
        $whychoose->service_charge =  $request->servCharge;
        $whychoose->save();
        return redirect()->back()->with('success', 'Successfully add new data!');
    }

    public function faq()
    {
        $faqres = Faq::all();
        return view('pages.app_faq', compact('faqres'));
    }
    public function faqCreate()
    {
        return view('pages.app_faq_create');
    }
    public function faqCreateStore(Request $request)
    {
        $faq = new  Faq();
        $faq->created_by     =  $request->user;
        $faq->title          =  $request->name;
        $faq->faqs_text      =  $request->faqtext;

        $faq->save();
        return redirect()->back()->with('success', 'Successfully add new FAQ!');
    }
    public function faqEdit($id)
    {
        $faq = Faq::find($id);
        return view('pages.app_faq_edit', compact('faq'));
    }
    public function faqEditStore(Request $request, $id)
    {
        $faq = Faq::find($id);
        $faq->created_by     =  $request->user;
        $faq->title          =  $request->name;
        $faq->faqs_text       =  $request->faqtext;

        $faq->update();
        return redirect()->back()->with('success', 'Successfully update FAQ!');
    }

    public function aboutus()
    {
        $about = AboutUs::all();
        return view('pages.app_about', compact('about'));
    }
    public function aboutusCreate()
    {
        return view('pages.app_about_create');
    }
    public function aboutusCreateStore(Request $request)
    {
        $aboutdata = new AboutUs();
        $aboutdata->created_by     =  $request->user;
        $aboutdata->title          =  $request->name;
        $aboutdata->about_text     =  $request->aboutText;
        $aboutdata->save();
        return redirect()->back()->with('success', 'Successfully add new about!');
    }

    public function aboutusEdit($id)
    {
        $result = AboutUs::find($id);
        return view('pages.app_about_edit', compact('result'));
    }
    public function aboutusEditUpdate(Request $request, $id)
    {
        $aboutdata = AboutUs::find($id);
        $aboutdata->created_by     =  $request->user;
        $aboutdata->title          =  $request->title;
        $aboutdata->about_text     =  $request->aboutText;
        $aboutdata->update();
        return redirect()->back()->with('success', 'Successfully add new about!');
    }
    public function aboutusData()
    {
        //return view('pages.app_about_store');
    }
    public function customersupport()
    {
        $support = Support::all();
        return view('pages.app_support', compact('support'));
    }
    public function customersupportCreate()
    {
        return view('pages.app_support_create');
    }
    public function customersupportCreateStore(Request $request)
    {
        $support = new Support();
        $support->created_by    = $request->user;
        $support->support_email = $request->supportEmail;
        $support->support_phone = $request->supportPhone;
        $support->save();
        return redirect()->back()->with('success', 'Successfully data are added!');
    }
    public function customersupportEdit($id)
    {
        $result = Support::find($id);
        return view('pages.app_support_edit', compact('result'));
    }
    public function customersupportEditStore(Request $request, $id)
    {
    }

    public function customersupportData()
    {
        //return view('pages.app_support_data');
    }
}

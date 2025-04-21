<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;

class FrontendController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::where('enabled', 1)->get();

        //        return view('website.index', compact('plans'));
        return view('frontend.home.index', compact('plans'));
    }

    public function installation()
    {
        return view('frontend.pages.installation.index');
    }

    public function customization()
    {
        return view('frontend.pages.customization.index');
    }

    public function maintenance()
    {
        return view('frontend.pages.maintenance.index');
    }

    public function blogs()
    {
        return view('frontend.pages.blogs.index');
    }

    // about ua page
    public function aboutUs()
    {
        return view('frontend.pages.about-us.index');
    }

    // our Client
    public function ourClients()
    {
        return view('frontend.pages.clients.index');
    }

    // contact with us
    public function contactUs()
    {
        return view('frontend.pages.contact-us.index');

    }

    // terms and condition
    public function terms()
    {
        return view('frontend.pages.policy.terms-and-conditions');

    }

    // privacy policy
    public function privacy()
    {
        return view('frontend.pages.policy.privacy-policy');

    }

    // email template
    public function subscriptionExpire()
    {
        return view('frontend.pages.email-template.sub-expire');

    }

    public function welcome()
    {
        return view('frontend.pages.email-template.welcome');

    }

    public function invoice()
    {
        return view('frontend.pages.email-template.invoice');

    }

    public function discount()
    {
        return view('frontend.pages.email-template.discount');

    }
}

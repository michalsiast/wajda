<?php


namespace App\Http\Controllers;




use App\Mail\FormContactMail;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{

    public function showContactForm($view) {
        $key = Config::with([])
            ->where('name', '=', 'google_app_recaptcha2_site_key')
            ->first();

        $view->siteKey = $key->value ?? '';
    }


    public function contactForm() {
        $lang = request()->header('lang', app()->getLocale());
        app()->setLocale($lang);

        $post = request()->post();
        $validator = Validator::make($post, [
            'name' => ['required'],
            'email' => ['sometimes', 'nullable', 'required_without:phone', 'email'],
            'phone' => ['required_without:email'],
            'rule' => ['required'],
            'g-recaptcha-response' => ['required'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }


        $sendTo = getConstField('contact_form_email');
        if(empty($sendTo)) {
            return response()->json(['status' => 'error', 'message' => 'Fill contact_form_email in const fields!']);
        }


        Mail::to($sendTo)->send(new FormContactMail($post));


        return response()->json(['status' => 'success', 'message' => __('admin.email.message.success')]);
    }
}

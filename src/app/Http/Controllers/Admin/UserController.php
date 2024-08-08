<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\UserForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function show() {
        $form = new UserForm(Auth::user());
        $form->fields['password']['value'] = '';
        $form->fields['password_repeat']['value'] = '';

        return view('admin.user.edit', compact( 'form'));
    }

    public function edit(UserRequest $request) {
        $post = $request->post('users');

        $user = Auth::user();
        $user->name = $post['name'];
        $user->email = $post['email'];
        $user->lang = $post['lang'];
        $user->theme = $post['theme'];

        if($post['password']) {
            $post['password'] = Hash::make($post['password']);

            $user->password = $post['password'];
        }

        $user->save();

        return redirect()->route('admin.user.show');
    }
}

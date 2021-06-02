<?php

namespace App\Http\Controllers;

use App\Models\MAdmin;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function store(Request $request)
    {
        try {
            $validator = [];
            $user = auth()->user();

            $currentPasswordValidator = Validator::make($request->only('current_password'), [
                'current_password' => new MatchOldPassword()
            ]);
            if ($currentPasswordValidator->fails()) {
                $validator['success'] = false;
                $validator['message']['new_password_error'] = 'ログインユーザのパスワードは正しくありません。';
                return response()->json($validator, 200);
            }

            $new_confirm_password_credential = $request->only('new_confirm_password', 'new_password');
            $new_confirm_password_rules = [
                'new_confirm_password' => 'same:new_password'
            ];
            $new_confirm_password_validator = Validator::make($new_confirm_password_credential, $new_confirm_password_rules);
            if ($new_confirm_password_validator->fails()) {
                $validator['success'] = false;
                $validator['message']['new_password_error'] = '新しいパスワードと確認用のパスワードは相違がありました。';
                return response()->json($validator, 200);

            }

            $new_password_credential = $request->only('new_password');
            $new_password_rules = [
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                ],
            ];
            $new_password_validator = Validator::make($new_password_credential, $new_password_rules);
            if ($new_password_validator->fails()) {
                $validator['success'] = false;
                $validator['message']['new_password_error'] = '設定パスワードは8文字以上の英数字記号(#$%&+-*)をご利用ください。';
                return response()->json($validator, 200);
            }

            if (isset($validator['success']) && $validator['success'] == false) {
                return response()->json($validator, 200);
            }

            MAdmin::find($user->admin_id)->update(['password'=> Hash::make($request->new_password), 'last_update' => date(TIME_FORMAT)]);

        } catch (\Throwable $e) {
            throw $e;
        }
        Auth::logout();
        Session::flush();
        return response()->json(['success' => true]);
    }
}

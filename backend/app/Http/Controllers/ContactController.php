<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\BareMail;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ContactNotification;

class ContactController extends Controller
{
    use Notifiable;

    private $formItems = [
        'nickname',
        'email',
        'name',
        'title',
        'body',
    ];

    /**
     * お問い合わせメール送信フォーム
     */
    public function show()
    {
        return view('contact.form');
    }

    /**
     * お問い合わせメール送信内容確認
     */
    public function post(ContactRequest $request)
    {

        $input = $request->only($this->formItems);

        //セッションに書き込む
        $request->session()->put("form_input", $input);

        return redirect()->route('contact.confirm');
    }

    /**
     * お問い合わせメール送信確認画面
     */
    public function confirm(Request $request)
    {
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        //セッションに値が無い時はフォームに戻る
        if (!$input) {
            return redirect()->route('contact.show');
        }
        return view('contact.confirm', ['input' => $input]);
    }

    /**
     * お問い合わせメール送信処理
     */
    public function send(Request $request)
    {
        $input = $request->session()->get("form_input");

        if ($request->has("back")) {
            return redirect()->route('contact.show')
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->route('contact.show');
        }

        $contact = Contact::create([
            'nickname' => $input['nickname'],
            'email' => $input['email'],
            'name' => $input['name'],
            'title' => $input['title'],
            'body' => $input['body'],
        ]);

        $contact->notify(new ContactNotification(new BareMail()));

        $request->session()->forget("form_input");

        return redirect()->route('contact.complete');
    }

    public function complete()
    {
        return view('contact.complete');
    }
}

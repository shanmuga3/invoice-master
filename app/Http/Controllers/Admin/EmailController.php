<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSettings;
use Lang;

class EmailController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->base_path = 'admin.email_settings.';
        $this->base_url = $this->view_data['base_url'] = route('admin.email_settings');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->base_path.'edit', $this->view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validateRequest($request);

        EmailSettings::where(['name' => 'driver'])->update(['value' => $request->driver]);
        EmailSettings::where(['name' => 'host'])->update(['value' => $request->host]);
        EmailSettings::where(['name' => 'port'])->update(['value' => $request->port]);
        EmailSettings::where(['name' => 'from_address'])->update(['value' => $request->from_address]);
        EmailSettings::where(['name' => 'from_name'])->update(['value' => $request->from_name]);
        EmailSettings::where(['name' => 'encryption'])->update(['value' => $request->encryption]);
        EmailSettings::where(['name' => 'username'])->update(['value' => $request->username]);
        EmailSettings::where(['name' => 'password'])->update(['value' => $request->app_password]);

        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.updated_successfully'));
        return redirect($this->base_url);
    }

    /**
     * Validate Current Request
     *
     * @param  Illuminate\Http\Request $request_data
     * @param  Int $id
     * @return Array
     */
    protected function validateRequest($request_data)
    {
        $rules = array(
            'driver'       => 'required|in:smtp,sendmail,mailgun,ses,postmark',
            'host'         => 'required',
            'port'         => 'required',
            'from_address' => 'required',
            'from_name'    => 'required',
            'encryption'   => 'required',
            'username'     => 'required',
            'app_password' => 'required'
        );

        $this->validate($request_data,$rules);
    }
}
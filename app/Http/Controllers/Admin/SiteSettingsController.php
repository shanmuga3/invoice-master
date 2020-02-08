<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSettings;
use Lang;

class SiteSettingsController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->base_path = 'admin.site_settings.';
        $this->base_url = $this->view_data['base_url'] = route('admin.site_settings');
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

        SiteSettings::where(['name' => 'site_name'])->update(['value' => $request->site_name]);
        SiteSettings::where(['name' => 'site_version'])->update(['value' => $request->site_version]);
        SiteSettings::where(['name' => 'admin_url'])->update(['value' => $request->admin_url]);
        SiteSettings::where(['name' => 'support_number'])->update(['value' => $request->support_number]);

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
            'site_name'         => 'required',
            'site_version'      => 'required',
            'admin_url'         => 'required',
            'support_number'    => 'required',
        );

        $this->validate($request_data,$rules);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CustomersDataTable;
use App\Models\User;
use Lang;

class CustomersController extends Controller
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->base_path = 'admin.customers.';
        $this->base_url = $this->view_data['base_url'] = route('admin.customers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render($this->base_path.'view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view_data['result'] = new User;
        return view($this->base_path.'add', $this->view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $validated = $request->except(['_token']);

        User::create($validated);

        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.added_successfully'));
        return redirect($this->base_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->view_data['result'] = User::findOrFail($id);
        return view($this->base_path.'edit', $this->view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->alt_number = $request->alt_number;
        $user->address_line_1 = $request->address_line_1;
        $user->address_line_2 = $request->address_line_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->postal_code = $request->postal_code;
        $user->country_code = $request->country_code;
        $user->status = $request->status;

        if($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->save();

        flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.updated_successfully'));

        return redirect($this->base_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $can_destroy = $this->canDestroy($id);
        
        if(!$can_destroy['status']) {
            flashMessage('danger', Lang::get('admin_messages.failed'), $can_destroy['status_message']);
            return redirect($this->base_url);
        }
        
        try {
            User::find($id)->delete();
            flashMessage('success', Lang::get('admin_messages.success'), Lang::get('admin_messages.delete_success'));
        }
        catch (Exception $e) {
            flashMessage('danger', Lang::get('admin_messages.failed'), $e->getMessage());
        }

        return redirect($this->base_url);
    }

    /**
     * Check the specified resource Can be deleted or not.
     *
     * @param  int  $id
     * @return Array
     */
    protected function canDestroy($id)
    {
        return ['status' => true,'status_message' => ''];
    }

    /**
     * Validate the Given Request
     *
     * @param  Illuminate\Http\Request $request_data
     * @param  Int $id
     * @return Array
     */
    protected function validateRequest($request_data, $id = '')
    {
        $password_rule = ($id == '') ? 'nullable|':'required|';
        $rules = array(
            "first_name"    => "required|max:20",
            "last_name"     => "required|max:20",
            'email'         => 'required|email|unique:admins,email,'.$id,
            'password'      => $password_rule.'min:8',
            "mobile_number" => "required|numeric",
            "alt_number"    => "numeric",
            "address_line_1"=> "required",
            "city"          => "required",
            "state"         => "required",
            "postal_code"   => "required",
            "country_code"  => "required",
            'status'        => 'required',
        );

        $attributes = array(
            "first_name"    => "First Name",
            "last_name"     => "Last Name",
            'email'         => 'Email',
            'password'      => 'Password',
            "mobile_number" => "Mobile Number",
            "alt_number"    => "Alt. Mobile Number",
            "address_line_1"=> "Address Line 1",
            "city"          => "City",
            "state"         => "State",
            "postal_code"   => "Postal Code",
            "country_code"  => "Country Code",
            'status'        => 'Status',
        );

        $this->validate($request_data,$rules,[],$attributes);
    }
}
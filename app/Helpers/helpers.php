<?php

/**
 * Set Flash Message function
 *
 * @param  string $class     Type of the class ['danger','success','warning','info']
 * @param  string $message   message to be displayed
 */
if(!function_exists('flashMessage')) {
    function flashMessage($class, $message)
    {
        Session::flash('alert-class', 'alert-'.$class);
        Session::flash('message', $message);
    }
}

/**
 * File Get Content by using CURL
 *
 * @param  string $url  Url
 * @return string $data Response of URL
 */
if (!function_exists('file_get_contents_curl')) {

	function file_get_contents_curl($url)
	{
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

	    $data = curl_exec($ch);
	    curl_close($ch);

	    return $data;
	}
}

/**
 * Check Current Route is inside given array
 *
 * @param  String route names
 * @return boolean true|false
 */
if (!function_exists('isActiveRoute')) {

	function isActiveRoute()
	{
		$routes = func_get_args();
        return in_array(request()->route()->getName(),$routes);
	}
}

/**
 * Get Site Base Url
 *
 * @return String $url Base url
 */
if (!function_exists('siteUrl')) {

	function siteUrl()
	{
		$site_settings_url = site_settings('site_url');
		$url = \App::runningInConsole() ? $site_settings_url : url('/');
		return $url;
	}
}

/**
 * Resolve Site Settings and get value of given string
 *
 * @param  string $key Name of the value to get
 * @return String
 */
if (!function_exists('site_settings')) {

	function site_settings($key)
	{
		$site_settings = resolve('site_settings');
		$site_setting = $site_settings->where('name',$key)->first();
		
		return optional($site_setting)->value;
	}
}

/**
 * Resolve Fees and get value of given string
 *
 * @param  string $key Name of the value to get
 * @return String
 */
if (!function_exists('fees')) {

	function fees($key)
	{
		$fees = resolve('fees');
		$fee = $fees->where('name',$key)->first();
		
		return optional($fee)->value;
	}
}

/**
 * Resolve Site Settings and get value of given string
 *
 * @param  string $key Name of the value to get
 * @return String
 */
if (!function_exists('email_config')) {

	function email_config($key)
	{
		$email_config = resolve('email_settings');
		$config = $email_config->where('name',$key)->first();
		
		return optional($config)->value;
	}
}
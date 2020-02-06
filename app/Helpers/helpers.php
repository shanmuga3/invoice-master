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

<?php

namespace App\Traits;

trait NotificationHelper
{
    /**
     * Flash a success message and redirect
     *
     * @param  string  $message
     * @param  string|null  $redirectTo
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function successResponse($message, $redirectTo = null)
    {
        session()->flash('success', $message);

        return $redirectTo ? redirect($redirectTo) : redirect()->back();
    }

    /**
     * Flash an error message and redirect
     *
     * @param  string  $message
     * @param  string|null  $redirectTo
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function errorResponse($message, $redirectTo = null)
    {
        session()->flash('error', $message);

        return $redirectTo ? redirect($redirectTo) : redirect()->back();
    }

    /**
     * Flash a warning message and redirect
     *
     * @param  string  $message
     * @param  string|null  $redirectTo
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function warningResponse($message, $redirectTo = null)
    {
        session()->flash('warning', $message);

        return $redirectTo ? redirect($redirectTo) : redirect()->back();
    }

    /**
     * Flash an info message and redirect
     *
     * @param  string  $message
     * @param  string|null  $redirectTo
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function infoResponse($message, $redirectTo = null)
    {
        session()->flash('info', $message);

        return $redirectTo ? redirect($redirectTo) : redirect()->back();
    }
}

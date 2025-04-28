<?php

namespace App\Http\Controllers\Auth;

use TCG\Voyager\Http\Controllers\VoyagerAuthController;
use Illuminate\Http\Request;

class LoginController extends VoyagerAuthController
{
    /**
     * Redirigir al usuario después del login exitoso.
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect('/admin');
    }
}

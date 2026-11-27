<?php

namespace Innoboxrr\LivewireComments\Http\Controllers;

class UserController extends Controller
{
    public function avatar($id)
    {
        // findOrFail: con un id inexistente, 404 y no un error 500.
        $user = config('lwc.user_class')::findOrFail($id);
        $avatarUrl = $user->avatar;
        return redirect($avatarUrl, 302);
    }

}

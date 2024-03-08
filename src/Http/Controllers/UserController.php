<?php

namespace Innoboxrr\LivewireComments\Http\Controllers;

class UserController extends Controller
{
    public function avatar($id)
    {
        $user = config('lwc.user_class')::find($id);
        $avatarUrl = $user->avatar;
        return redirect($avatarUrl, 302);
    }

}

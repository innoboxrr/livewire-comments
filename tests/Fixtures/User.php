<?php

namespace Innoboxrr\LivewireComments\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * El usuario de la aplicacion anfitriona: lwc.user_class apunta aqui.
 */
class User extends Authenticatable
{
    protected $table = 'users';

    protected $guarded = [];
}

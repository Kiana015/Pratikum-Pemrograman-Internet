<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use App\Notifications\adminNotif;

    class Admin extends Authenticatable
    {
        use Notifiable;
        protected $guard = 'admin';

        protected $fillable = [
            'name', 'username', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }
?>
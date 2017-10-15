<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
	 * @return mixed
	 */
	public function getLevelMax()
	{
		$roles = [];
		foreach($this->roles as $role)
		{
			$roles[] = $role->level;
		}

		return max($roles);
	}

  public function detachAllRoles()
  {
      \DB::table('role_user')->where('user_id', $this->user_id)->delete();

      return $this;
  }
}

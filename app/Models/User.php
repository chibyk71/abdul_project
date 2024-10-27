<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'role'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}


	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 */
	public function sendPasswordResetNotification($token): void
	{
		$this->notify(new ResetPassword($token));
	}

	/**
	 * Send the email verification notification.
	 */
	public function sendEmailVerificationNotification(): void
	{
		$this->notify(new VerifyEmail());
	}

	public function isAdmin() {
		return $this->role == 'Admin';
	}

	public function student() {
		return $this->hasOne(Student::class,);
	}
}

<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Models\Flight;
class FlightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user,Flight $flight)
    {
        $user = Auth::user();
        return $user->can('read_flight');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function view(User $user, Flight $flight)
    {
        $user = Auth::user();
        return $user->can('read_flight');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function update(User $user, Flight $flight)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function delete(User $user, Flight $flight)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function restore(User $user, Flight $flight)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function forceDelete(User $user, Flight $flight)
    {
        //
    }
}

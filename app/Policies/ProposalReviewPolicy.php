<?php

namespace App\Policies;

use App\Models\User;
use App\Models\proposalReview;
use Illuminate\Auth\Access\Response;

class ProposalReviewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, proposalReview $proposalReview): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, proposalReview $proposalReview): bool
    {
        alert()->error('Gagal', 'Anda tidak memiliki akses untuk mengubah data ini');
        return $proposalReview->reviewer_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, proposalReview $proposalReview): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, proposalReview $proposalReview): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, proposalReview $proposalReview): bool
    {
        return false;
    }
}

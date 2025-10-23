<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MailService
{
    public function getAllAdminEmails()
    {
        $admins = User::role('admin')->get(); // Spatie's role scope

        return $admins->pluck('email');
    }

    public function getAllSuperAdminEmails()
    {
        $superAdmins = User::role('super-admin')->get(); // Spatie's role scope

        return $superAdmins->pluck('email');
    }

    public function getApplicantEmail($applicantId)
    {
        $applicant = User::find($applicantId);
        return $applicant ? $applicant->email : null;
    }
}

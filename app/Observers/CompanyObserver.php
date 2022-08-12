<?php

namespace App\Observers;

use App\Models\Company;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Auth;

class CompanyObserver
{
    use FileUpload;

    public function creating(Company $company)
    {
        $company->company_url = url('/') . '/' . str_replace(" ", "_", request()->get('company_name'));
        $company->created_by = Auth::user()->id;
    }

    public function saved(Company $company)
    {
        if (request()->has('image')) {
            $meta = $this->uploadImage(request()->file('image'), 'public/company');
            $this->saveToDB($company, $meta);
        }
    }
}

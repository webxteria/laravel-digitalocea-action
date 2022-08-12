<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function index(Request $request, Company $company)
    {
        return CompanyResource::collection(
            $company
                ->with([
                    'image',
                    'channels' => function ($query) {
                        return $query->ActiveChannels();
                    },
                    'groups' => function ($query) {
                        return $query->ActiveGroups();
                    }
                ])
                ->paginate($request->input('per_page', 10))
        );
    }

    public function store(CompanyRequest $request, Company $company)
    {
        return new CompanyResource(
            $company
                ->create($request->validated())
        );
    }

    public function show(Company $company)
    {
        return new CompanyResource(
            $company->load([
                'image',
                'channels' => function ($query) {
                    return $query->ActiveChannels();
                },
                'groups' => function ($query) {
                    return $query->ActiveGroups();
                }
            ])
        );
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return $this->show($company);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->noContent();
    }
}

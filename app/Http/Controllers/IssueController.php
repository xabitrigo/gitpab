<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequest;
use App\Model\Repository\ContributorRepositoryEloquent;
use App\Model\Repository\ProjectRepositoryEloquent;
use App\Model\Service\Eloquent\EloquentIssueService;
use App\Providers\AppServiceProvider;

class IssueController extends CrudController
{
    /**
     * @return EloquentIssueService
     */
    protected function getService()
    {
        return app(EloquentIssueService::class);
    }

    protected function prepareDataForIndex(FormRequest $request, array $data)
    {
        /** @var ContributorRepositoryEloquent $contributorRepository */
        $contributorRepository = app(AppServiceProvider::CONTRIBUTOR_REPOSITORY);

        /** @var ProjectRepositoryEloquent $projectRepository */
        $projectRepository = app(AppServiceProvider::PROJECT_REPOSITORY);

        return array_merge(
            $data,
            [
                'assigneeList' => $contributorRepository->getItemsForSelect(),
                'projectsList' => $projectRepository->getItemsForSelect(),
            ]
        );
    }
}

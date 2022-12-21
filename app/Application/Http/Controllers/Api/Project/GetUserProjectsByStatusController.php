<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers\Api\Project;

use App\Application\Http\Controllers\Controller;
use App\Application\Http\Requests\Project\GetUserProjectsRequest;
use App\Domain\Project\ProjectService;
use App\Domain\User\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetUserProjectsByStatusController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function __invoke(User $user, GetUserProjectsRequest $request): JsonResponse
    {
        return new JsonResponse(
            [
                'results' => $request->get('group_by_status')
                    ? $this->projectService->getAllUserProjectsGroupedByStatus($user)
                    : $user->projects()->withTrashed()->get(),
                'nb_results' => 1,
            ],
            Response::HTTP_OK,
        );
    }
}

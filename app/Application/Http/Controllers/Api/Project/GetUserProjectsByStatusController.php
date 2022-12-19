<?php

namespace App\Application\Http\Controllers\Api\Project;

use App\Application\Http\Controllers\Controller;
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

    public function __invoke(User $user): JsonResponse
    {
        return new JsonResponse(
            [
                'results' => $this->projectService->getAllUserProjectsGroupedByStatus($user),
                'nb_results' => 1,
            ],
            Response::HTTP_OK,
        );
    }
}

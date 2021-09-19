<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'projects')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('projects/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Repository\PortfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/{id}', name: 'home', defaults: ['id' => 1])]
    public function home(int $id, PortfolioRepository $portfolioRepository): Response
    {
        /** @var Portfolio|null $portfolio */
        $portfolio = $portfolioRepository->find($id);

        if (!$portfolio) {
            $portfolio = Portfolio::placeholder();
        }

        return $this->render('layout.html.twig', [
            'portfolio' => $portfolio,
        ]);
    }
}
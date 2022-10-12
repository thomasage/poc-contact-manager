<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\Homepage;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\Error;

final class HomepageViewHTML
{
    public function __construct(private readonly Environment $twig)
    {
    }

    /**
     * @throws Error
     */
    public function render(HomepageViewModelHTML $viewModel): Response
    {
        return new Response(
            $this->twig->render('homepage.html.twig', [
                'vm' => $viewModel,
            ])
        );
    }
}

<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\Error;

final class ContactAddViewHTML
{
    public function __construct(private readonly Environment $twig)
    {
    }

    /**
     * @throws Error
     */
    public function render(ContactAddViewModelHTML $viewModel, FormInterface $form): Response
    {
        if ($viewModel->redirectTo) {
            return new RedirectResponse($viewModel->redirectTo);
        }

        return new Response(
            $this->twig->render('add.html.twig', [
                'form' => $form->createView(),
                'vm' => $viewModel,
            ])
        );
    }
}

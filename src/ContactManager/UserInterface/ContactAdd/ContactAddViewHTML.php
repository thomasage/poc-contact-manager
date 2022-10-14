<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig\Environment;
use Twig\Error\Error;

final class ContactAddViewHTML
{
    public function __construct(private readonly RequestStack $requestStack, private readonly Environment $twig)
    {
    }

    /**
     * @throws Error
     */
    public function render(ContactAddViewModelHTML $viewModel, FormInterface $form): Response
    {
        /** @var Session $session */
        $session = $this->requestStack->getSession();
        $flashBag = $session->getFlashBag();
        foreach ($viewModel->flashes as $flash) {
            $flashBag->add($flash['type'], $flash['message']);
        }

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

<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

use App\ContactManager\Application\AddContact\AddContactPresenter;
use App\ContactManager\Application\AddContact\AddContactResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ContactAddPresenterHTML implements AddContactPresenter
{
    public readonly ContactAddViewModelHTML $viewModel;
    private readonly FlashBagInterface $flashBag;

    public function __construct(
        RequestStack $requestStack,
        private readonly RouterInterface $router,
        private readonly TranslatorInterface $translator,
    ) {
        /** @var Session $session */
        $session = $requestStack->getSession();
        $this->flashBag = $session->getFlashBag();
        $this->viewModel = new ContactAddViewModelHTML();
    }

    public function present(AddContactResponse $response): void
    {
        if ($response->id) {
            $this->flashBag->add('success', $this->translator->trans('notification.contact_added'));
            $this->viewModel->redirectTo = $this->router->generate('app_homepage');
        }
        foreach ($response->errors as $error) {
            $this->flashBag->add('danger', $this->translator->trans('notification.error_'.$error));
        }
    }
}

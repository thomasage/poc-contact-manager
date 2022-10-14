<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

use App\ContactManager\Application\AddContact\AddContactPresenter;
use App\ContactManager\Application\AddContact\AddContactResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ContactAddPresenterHTML implements AddContactPresenter
{
    public readonly ContactAddViewModelHTML $viewModel;

    public function __construct(
        private readonly RouterInterface $router,
        private readonly TranslatorInterface $translator,
    ) {
        $this->viewModel = new ContactAddViewModelHTML();
    }

    public function present(AddContactResponse $response): void
    {
        if ($response->id) {
            $this->viewModel->flashes[] = [
                'type' => 'success',
                'message' => $this->translator->trans('notification.contact_added'),
            ];
            $this->viewModel->redirectTo = $this->router->generate('app_homepage');
        }
        foreach ($response->errors as $error) {
            $this->viewModel->flashes[] = [
                'type' => 'danger',
                'message' => $this->translator->trans('notification.error_'.$error),
            ];
        }
    }
}

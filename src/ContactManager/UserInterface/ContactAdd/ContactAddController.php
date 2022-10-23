<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

use App\ContactManager\Application\AddContact\AddContactHandler;
use App\ContactManager\Application\AddContact\AddContactRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ContactAddController extends AbstractController
{
    public function __construct(
        private readonly AddContactHandler $handler,
        private readonly ContactAddPresenterHTML $presenter,
        private readonly ContactAddViewHTML $view,
    ) {
    }

    #[Route('/add', name: 'app_add')]
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(ContactAddForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ContactAddFormData $formData */
            $formData = $form->getData();
            $handlerRequest = new AddContactRequest();
            $handlerRequest->name = $formData->name;
            $this->handler->handle($handlerRequest, $this->presenter);
        }

        return $this->view->render($this->presenter->viewModel, $form);
    }
}

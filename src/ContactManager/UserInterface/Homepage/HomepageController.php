<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\Homepage;

use App\ContactManager\Application\GetAllContacts\GetAllContactsHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomepageController extends AbstractController
{
    public function __construct(
        private readonly GetAllContactsHandler $handler,
        private readonly HomepagePresenterHTML $presenter,
        private readonly HomepageViewHTML $view,
    ) {
    }

    #[Route('/', name: 'app_homepage')]
    public function __invoke(): Response
    {
        $this->handler->handle($this->presenter);

        return $this->view->render($this->presenter->viewModel);
    }
}

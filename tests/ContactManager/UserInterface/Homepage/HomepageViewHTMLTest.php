<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\UserInterface\Homepage;

use App\ContactManager\UserInterface\Homepage\HomepageViewHTML;
use App\ContactManager\UserInterface\Homepage\HomepageViewModelHTML;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

final class HomepageViewHTMLTest extends TestCase
{
    public function testShouldReturnCode200(): void
    {
        $twig = $this->createMock(Environment::class);
        $view = new HomepageViewHTML($twig);
        $viewModel = new HomepageViewModelHTML();

        $response = $view->render($viewModel);

        self::assertSame(200, $response->getStatusCode());
    }
}

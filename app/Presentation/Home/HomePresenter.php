<?php
declare(strict_types=1);

namespace App\Presentation\Home;

use App\Model\PostFacade;
use Nette;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private PostFacade $facade,
    ) {}

    public function renderDefault(): void
    {
        // Zjistíme, jestli je přihlášený uživatel admin
        $isAdmin = $this->getUser()->isLoggedIn() && $this->getUser()->isInRole('admin');
    
        // Pošleme to do facady a výsledek do šablony
        $this->template->posts = $this->facade->getArticlesForUser($isAdmin);
    }
}

<?php

namespace App\Presentation\Post;

use App\Model\PostFacade;
use Nette;

final class PostPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $facade,
	) {}

	public function renderShow(int $postId): void
	{
		$post = $this->facade->getPostById($postId);
		if (!$post) {
			$this->error('Příspěvek nenalezen');
		}
		$this->template->post = $post;
	}

public function handleLiked(int $postId, int $liked): void
{
    if (!$this->getUser()->isLoggedIn()) {
        $this->flashMessage('Pro hodnocení se musíš přihlásit.', 'error');
        // AJAXem se redirect dělá blbě, tak aspoň takto:
        if (!$this->isAjax()) {
            $this->redirect('Sign:in');
        }
        return;
    }

    $this->facade->updateRating($this->getUser()->getId(), $postId, $liked);

    if ($this->isAjax()) {
        // Tohle řekne Nette: "Překresli jen ten snippet ratingArea"
        $this->redrawControl('ratingArea');
        // Pokud chceš překreslit i flash zprávy, musel bys mít snippet i na ně
        $this->redrawControl('flashes'); 
    } else {
        $this->flashMessage('Díky za hodnocení!');
        $this->redirect('this');
    }
}
}

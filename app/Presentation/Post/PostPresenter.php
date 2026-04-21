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
    	// 1. Zkontrolujeme, zda je uživatel přihlášen
    	if (!$this->getUser()->isLoggedIn()) {
        	$this->flashMessage('Pro hodnocení se musíš přihlásit.', 'error');
        	$this->redirect('Sign:in');
    	}

    	// 2. Voláme metodu z Facady
    	$this->facade->updateRating($this->getUser()->getId(), $postId, $liked);

    	// 3. Informujeme uživatele a překreslíme stránku
    	$this->flashMessage('Díky za hodnocení!');
    	$this->redirect('this'); // Zůstane na stejné stránce
	}
}

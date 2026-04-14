<?php

namespace App\Module\Admin\Presenters;

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
			$this->error('Příspěvek nebyl nalezen');
		}
		$this->template->post = $post;
	}
}
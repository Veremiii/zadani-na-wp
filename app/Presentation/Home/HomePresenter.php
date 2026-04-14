<?php

namespace App\Module\Admin\Presenters; // Pozor na tento namespace podle zadání!

use App\Model\PostFacade;
use Nette;

final class HomePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $facade,
	) {}

	public function renderDefault(): void
	{
		// Výpis příspěvků
		$this->template->posts = $this->facade->getPublicArticles()->limit(10);
	}
}
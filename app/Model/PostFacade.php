<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

final class PostFacade
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {}

    /**
     * Vrátí články podle role uživatele.
     * Pokud je isAdmin true, vrátí vše. Pokud false, jen veřejné (is_public = 1).
     */
    public function getArticlesForUser(bool $isAdmin = false): Nette\Database\Table\Selection
    {
        $selection = $this->database->table('posts')
            ->where('created_at < ', new \DateTime)
            ->order('created_at DESC');

        // Pokud uživatel není admin, omezíme výběr jen na veřejné příspěvky
        if (!$isAdmin) {
            $selection->where('is_public', 1);
        }

        return $selection;
    }

    /**
     * Vrátí jeden konkrétní příspěvek podle ID.
     */
    public function getPostById(int $postId): ?Nette\Database\Table\ActiveRow
    {
        return $this->database->table('posts')->get($postId);
    }
}
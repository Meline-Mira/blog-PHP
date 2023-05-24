<?php

namespace App;

class Pagination
{
    public function __construct(public int $currentPage, public int $numberOfItems, public int $itemsPerPage, public string $path)
    {
    }

    public function numberOfPages(): int
    {
        return ceil($this->numberOfItems / $this->itemsPerPage);
    }

    public function pageLink(int $page): string
    {
        return $this->path . '?current_page=' . $page;
    }

    public function nextPageLink(): string
    {
        return $this->pageLink($this->currentPage + 1);
    }

    public function previousPageLink(): string
    {
        return $this->pageLink($this->currentPage - 1);
    }

    public function firstElementOnPage(): int
    {
        return ($this->currentPage - 1) * $this->itemsPerPage + 1;
    }

    public function lastElementOnPage(): int
    {
        return min($this->currentPage * $this->itemsPerPage, $this->numberOfItems);
    }

    public function isFirstPage(): bool
    {
        return $this->currentPage === 1;
    }

    public function isLastPage(): bool
    {
        return $this->currentPage === $this->numberOfPages();
    }
}

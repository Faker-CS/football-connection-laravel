<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public int $total;
    public int $perPage;
    public int $currentPage;
    public int $totalPages;
    public array $pages;
    public bool $hasPrevious;
    public bool $hasNext;
    public string $queryString;

    const WINDOW_SIZE = 3; // Show 3 pages on each side of current page

    public function __construct(int $total, int $perPage = 6, int $currentPage = 1)
    {
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = max(1, $currentPage);
        
        // Calculate total pages
        $this->totalPages = (int) ceil($this->total / $this->perPage);
        $this->currentPage = min($this->currentPage, $this->totalPages);

        // Navigation states
        $this->hasPrevious = $this->currentPage > 1;
        $this->hasNext = $this->currentPage < $this->totalPages;

        // Generate page numbers with window logic
        $this->pages = $this->generatePages();

        // Build query string from existing parameters
        $this->queryString = $this->buildQueryString();
    }

    /**
     * Generate page numbers with ellipsis
     * Shows: 1 ... 4 5 6 ... 10 format
     */
    private function generatePages(): array
    {
        $pages = [];

        if ($this->totalPages <= 1) {
            return $pages;
        }

        $start = max(1, $this->currentPage - self::WINDOW_SIZE);
        $end = min($this->totalPages, $this->currentPage + self::WINDOW_SIZE);

        // Always show first page
        if ($start > 1) {
            $pages[] = ['number' => 1, 'type' => 'page'];
            if ($start > 2) {
                $pages[] = ['number' => '...', 'type' => 'ellipsis'];
            }
        }

        // Show window pages
        for ($i = $start; $i <= $end; $i++) {
            $pages[] = [
                'number' => $i,
                'type' => 'page',
                'isActive' => $i === $this->currentPage
            ];
        }

        // Always show last page
        if ($end < $this->totalPages) {
            if ($end < $this->totalPages - 1) {
                $pages[] = ['number' => '...', 'type' => 'ellipsis'];
            }
            $pages[] = ['number' => $this->totalPages, 'type' => 'page'];
        }

        return $pages;
    }

    /**
     * Build query string preserving existing parameters except page
     */
    private function buildQueryString(): string
    {
        $params = request()->query();
        unset($params['page']);

        if (empty($params)) {
            return '';
        }

        return '&' . http_build_query($params);
    }

    /**
     * Get URL for a specific page
     */
    public function getPageUrl(int $page): string
    {
        return '?page=' . $page . $this->queryString;
    }

    /**
     * Get previous page URL
     */
    public function getPreviousUrl(): string
    {
        $page = $this->currentPage - 1;
        return $this->getPageUrl($page);
    }

    /**
     * Get next page URL
     */
    public function getNextUrl(): string
    {
        $page = $this->currentPage + 1;
        return $this->getPageUrl($page);
    }

    public function render()
    {
        // Build URLs for each page
        $pageUrls = [];
        foreach ($this->pages as $key => $page) {
            if ($page['type'] === 'page') {
                $pageUrls[$key] = $this->getPageUrl($page['number']);
            }
        }

        return view('components.pagination', [
            'pages' => $this->pages,
            'pageUrls' => $pageUrls,
            'currentPage' => $this->currentPage,
            'totalPages' => $this->totalPages,
            'hasPrevious' => $this->hasPrevious,
            'hasNext' => $this->hasNext,
            'previousUrl' => $this->getPreviousUrl(),
            'nextUrl' => $this->getNextUrl(),
        ]);
    }
}

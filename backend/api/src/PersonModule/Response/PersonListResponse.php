<?php

namespace App\PersonModule\Response;

class PersonListResponse
{

    /**
     * @var PersonListItem[]
     */
    private array $items;

    private int $limit;

    private int $offset;

    private int $total;

    /**
     * @param PersonListItem[] $items
     * @param int $limit
     * @param int $offset
     * @param int $total
     */
    public function __construct(array $items, int $limit, int $offset, int $total)
    {
        $this->items = $items;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->total = $total;
    }


    /**
     * @return PersonListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

}
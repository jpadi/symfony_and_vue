<?php

namespace App\PersonModule\Request;

class PersonListRequest
{
    private string $orderBy = "";

    private int $limit = 100;

    private int $offset = 0;

    /**
     * @param string $orderBy
     */
    public function __construct(string $orderBy, int $limit, int $offset)
    {
        $this->orderBy = $orderBy;
        $this->limit = $limit;
        $this->offset = 0;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
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


}
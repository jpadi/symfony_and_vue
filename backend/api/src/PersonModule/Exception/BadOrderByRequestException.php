<?php

namespace App\PersonModule\Exception;


class BadOrderByRequestException extends \Exception
{
    private $service;

    private $orderBy;

    public function __construct($service, $orderBy, \Throwable $previous = null)
    {
        parent::__construct(sprintf("Service \"%s\" dont allow order by \"%s\"",$service ,$orderBy), 400, $previous);
        $this->service = $service;
        $this->orderBy = $orderBy;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }


}
<?php

namespace App\PersonModule\Exception;


class DocumentNotFoundException extends \Exception
{
    private $document;

    private $id;

    /**
     * @param $document
     * @param $id
     */
    public function __construct($document, $id, \Throwable $previous = null)
    {
        parent::__construct(sprintf("Document  \"%s\" of type \"%s\" not found",$id ,$document), 404, $previous);
        $this->document = $document;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



}
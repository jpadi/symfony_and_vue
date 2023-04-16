<?php

namespace App\PersonModule\Service;

use App\PersonModule\Document\Person;
use App\PersonModule\Exception\BadOrderByRequestException;
use App\PersonModule\Request\PersonListRequest;
use App\PersonModule\Response\PersonListItem;
use App\PersonModule\Response\PersonListResponse;
use App\PersonModule\Repository\PersonRepository;

class PersonListService
{
    const NAME = "PersonListService";

    private PersonRepository $personRepository;

    private  string $orderByDefault  =  "name_asc";

    private array $orderBy = [
        "name_asc" => ["name"=> 1]
    ];

    public function __construct(PersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }

    /**
     * @param PersonListRequest $request
     * @return PersonListResponse
     * @throws BadOrderByRequestException
     */
    public function getList(PersonListRequest $request) : PersonListResponse {

        $filter = $this->getFilter($request);
        $orderBy = $this->getOrderBy($request);
        $limit = $request->getLimit();
        $offset = $request->getOffset();

        $personRepository =  $this->personRepository;

        /**
         * @var Person[] $personArray
         */
        $personArray = $personRepository->findBy($filter, $orderBy , $limit, $offset);
        $total = $personRepository->total($filter);

        $itemArray = [];

        foreach($personArray as $person) {
            $item = new PersonListItem($person->getId(), $person->getName(), $person->getEmail());
            $itemArray[] = $item;
        }

        return new PersonListResponse($itemArray, $limit, $offset, $total);
    }

    /** TODO: filter by something in future
     * @param PersonListRequest $request
     * @return array
     */
    private function getFilter(PersonListRequest $request) {
        return [];
    }

    /**
     * @param PersonListRequest $request
     * @return string
     * @throws BadOrderByRequestException
     */
    private function getOrderBy(PersonListRequest $request): array {

        if ($orderBy = $request->getOrderBy()) {
            if (!isset($this->orderBy[$orderBy])) {
                throw new BadOrderByRequestException(self::NAME, $orderBy);
            }
            return $this->orderBy[$orderBy];
        }
        return $this->orderBy[$this->orderByDefault];

    }

}
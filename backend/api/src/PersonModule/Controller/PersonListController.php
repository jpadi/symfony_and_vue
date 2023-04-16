<?php

namespace App\PersonModule\Controller;

use App\PersonModule\Request\PersonListRequest;
use App\PersonModule\Service\PersonListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonListController extends AbstractController
{

    private PersonListService $personListService;

    /**
     * @param PersonListService $personListService
     */
    public function __construct(PersonListService $personListService)
    {
        $this->personListService = $personListService;
    }


    /**
     * @Route("/api/v1/person", name="person_list", methods={"GET"})
     */
    public function getList() : Response {

        try {
            $request = new PersonListRequest("name_asc", 100, 0);
            $response = $this->personListService->getList($request);
            return $this->json($response);
            //$s->headers->set("Access-Control-Allow-Origin", "*");
            //return $s;
        } catch (\Exception $exception) {
            return $this->json(["error"=> "Server error"], 500);
        }
    }

}
<?php

namespace App\PersonModule\Controller;

use App\PersonModule\Exception\DocumentNotFoundException;
use App\PersonModule\Service\PersonGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonGetController  extends AbstractController
{

    private PersonGetService $personGetService;

    /**
     * @param PersonGetService $personGetService
     */
    public function __construct(PersonGetService $personGetService)
    {
        $this->personGetService = $personGetService;
    }

    /**
     * @Route("/api/v1/person/{id}", name="person_get", methods={"GET"})
     */
    public function get($id): Response{
        try {
            $response = $this->personGetService->get($id);
            return $this->json($response);
        } catch (DocumentNotFoundException $notFoundException){
            return $this->json(["error" => "Person \"$id\" not found"], $notFoundException->getCode());
        } catch (\Exception) {
            return $this->json(["error"=> "Server error"], 500);
        }
    }

}
<?php

namespace App\PersonModule\Controller;

use App\PersonModule\Exception\DocumentNotFoundException;
use App\PersonModule\Request\PersonDeleteRequest;
use App\PersonModule\Service\PersonDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonDeleteController extends AbstractController
{

    private PersonDeleteService $personDeleteService;

    /**
     * @param PersonDeleteService $personDeleteService
     */
    public function __construct(PersonDeleteService $personDeleteService)
    {
        $this->personDeleteService = $personDeleteService;
    }

    /**
     * @Route("/api/v1/person/{id}", name="person_delete", methods={"DELETE", "OPTIONS"})
     */
    public function delete(string $id, Request $request) :Response{

        // Cors request
        if ($request->getMethod() === "OPTIONS") {
            return new Response("");
        }

        try {
            $deleteRequest = new PersonDeleteRequest($id);
            $this->personDeleteService->delete($deleteRequest);
            return new Response("");
        }catch (DocumentNotFoundException $notFoundException) {
            // a not found Person is a deleted person!!
            return new Response("");
        } catch (\Exception) {
            return $this->json(["error"=> "Server error"], 500);
        }
    }

}
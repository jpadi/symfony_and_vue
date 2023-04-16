<?php

namespace App\PersonModule\Controller;

use App\PersonModule\Exception\ValidationException;
use App\PersonModule\Request\PersonUpdateRequest;
use App\PersonModule\Service\PersonCreateService;
use App\PersonModule\Service\PersonGetService;
use App\PersonModule\Service\PersonUpdateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonUpdateController extends AbstractController
{

    private PersonUpdateService $personUpdateService;

    private PersonGetService $personGetService;

    /**
     * @param PersonCreateService $personUpdateService
     * @param PersonGetService $personGetService
     */
    public function __construct(PersonUpdateService $personUpdateService, PersonGetService $personGetService)
    {
        $this->personUpdateService = $personUpdateService;
        $this->personGetService = $personGetService;
    }

    /**
     * @Route("/api/v1/person/{id}", name="person_update", methods={"PUT"})
     */
    public function update(string $id,Request $request) : Response {
        try {
            $json = json_decode($request->getContent(), true);
            $name = $json["name"]??"";
            $email = $json["email"]??"";
            $personCreateRequest = new PersonUpdateRequest($id, $name, $email);
            $this->personUpdateService->update($personCreateRequest);
            $response = $this->personGetService->get($id);
            return $this->json($response);
        } catch (ValidationException $exception) {
            return $this->json(["error"=> $exception->getMessage()], $exception->getCode());
        } catch (\Exception) {
            return $this->json(["error"=> "Server error"], 500);
        }
    }


}
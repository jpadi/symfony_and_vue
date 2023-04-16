<?php

namespace App\PersonModule\Controller;

use App\PersonModule\Exception\ValidationException;
use App\PersonModule\Request\PersonCreateRequest;
use App\PersonModule\Service\PersonCreateService;
use App\PersonModule\Service\PersonGetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonCreateController extends AbstractController
{

    private PersonCreateService $personCreateService;

    private PersonGetService $personGetService;

    /**
     * @param PersonCreateService $personCreateService
     * @param PersonGetService $personGetService
     */
    public function __construct(PersonCreateService $personCreateService, PersonGetService $personGetService)
    {
        $this->personCreateService = $personCreateService;
        $this->personGetService = $personGetService;
    }


    /**
     * @Route("/api/v1/person", name="person_create", methods={"POST", "OPTIONS"})
     */
    public function create(Request $request) : Response {

        // Cors request
        if ($request->getMethod() === "OPTIONS") {
            return new Response("");
        }

        try {
            $json = json_decode($request->getContent(), true);
            $name = $json["name"] ?? "";
            $email = $json["email"] ?? "";
            $personCreateRequest = new PersonCreateRequest($name, $email);
            $id = $this->personCreateService->create($personCreateRequest);
            $response = $this->personGetService->get($id);
            return $this->json($response);
        } catch (ValidationException $exception) {
            return $this->json(["error"=> $exception->getMessage()], $exception->getCode());
        } catch (\Exception) {
            return $this->json(["error"=> "Server error"], 500);
        }
    }


}
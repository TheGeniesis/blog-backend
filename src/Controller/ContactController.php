<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("contact", name="api_contact_index")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['email' => ['email@1.pl','email@2.pl']]);
    }
}

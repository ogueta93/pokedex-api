<?php
// src/Controller/PokedexController.php
namespace App\Controller;

use App\Service\PokeApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PokedexController extends AbstractController
{
    /**
     * Returns 50 elements and support a pageNumber parametre
     *
     * @param int $pageNumber
     * @return Json
     */
    public function getData($pageNumber, PokeApiService $pokeApiService)
    {
        return new JsonResponse(
            $pokeApiService->search($pageNumber)
        );
    }
}

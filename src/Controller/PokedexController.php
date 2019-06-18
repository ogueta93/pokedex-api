<?php
// src/Controller/PokedexController.php
namespace App\Controller;

use App\Service\PokeApiService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PokedexController extends Controller
{
    /**
     * Returns 50 elements and support a pageNumber parametre
     *
     * @param int $pageNumber
     * @return Json
     */
    public function getData($pageNumber)
    {

        $pokeApiService = $this->container->get(PokeApiService::class);

        return new JsonResponse(
            $pokeApiService->search($pageNumber)
        );
    }
}

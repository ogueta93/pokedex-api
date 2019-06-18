<?php
//src/Service/PokeApiService.php
namespace App\Service;

use App\Base\Service\AbstractService;
use \GuzzleHttp\Client;

class PokeApiService extends AbstractService
{
    const MAX_ELEMENTS = 50;

    /**
     * Search 50 elements with a page param
     *
     * @param int $pageNumber
     * @return array
     */
    public function search($pageNumber): array
    {
        $result = [];
        $start = ($pageNumber - 1) * self::MAX_ELEMENTS;
        $client = new Client();

        for ($i = 1; $i <= self::MAX_ELEMENTS; $i++) {
            try {
                $response = $client->request('GET', sprintf('%s%s', $this->config['serviceUrl'], $start + $i));
                $data = \json_decode($response->getBody()->getContents());

                $result[] = [
                    'id' => $data->id ?? null,
                    'name' => $data->name ?? null,
                    'types' => $data->types ?? null,
                    'images' => $data->sprites ?? null
                ];
            } catch (\Throwable $th) {
            }
        }

        return \array_merge(['count' => \count($result), 'results' => $result]);
    }

    /**
     * Sets config name
     *
     * @return void
     */
    protected function setConfigName()
    {
        $this->configName = 'pokeApi';
    }

    /**
     * Sets custom params
     *
     * @return void
     */
    protected function setCustomParams()
    {
    }
}

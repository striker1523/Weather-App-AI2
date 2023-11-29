<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use App\Entity\Measurement;
use App\Service\WeatherUtil;

class WeatherApiController extends AbstractController
{
    #[Route('/api/v1/weather', name: 'app_weather_api')]
    public function index(
        WeatherUtil $util,
        #[MapQueryParameter('country')] string $country,
        #[MapQueryParameter('city')] string $city,
        #[MapQueryParameter('format')] string $format,
        #[MapQueryParameter('twig')] bool $twig = false,
    ): Response
    {
        $measurements = $util->getWeatherForCountryAndCity($country, $city);
        
        if ($format == 'json'){
            if ($twig) {
                return $this->render('weather_api/index.json.twig', [
                    'city' => $city,
                    'country' => $country,
                    'measurements' => $measurements,
                ]);
            }else{
                return $this->json([
                    'city' => $city,
                    'country' => $country,
                    'measurements' => array_map(fn(Measurement $m) => [
                        'date' => $m->getDate()->format('Y-m-d'),
                        'celsius' => $m->getCelsius(),
                        'fahrenheit' => $m->getFahrenheit(),
                    ], $measurements),
                ]);
            }
        } else if ($format == 'csv'){
            if ($twig) {
                return $this->render('weather_api/index.csv.twig', [
                    'city' => $city,
                    'country' => $country,
                    'measurements' => $measurements,
                ]);
            } else {
                $raport = 'city, country, date, celsius, fahrenheit\n';
                $raport = implode(
                    "\n",
                    array_map(fn(Measurement $m) => sprintf(
                        '%s, %s, %s, %s',
                        $city,
                        $country,
                        $m->getDate()->format('Y-m-d'),
                        $m->getCelsius(),
                        $m->getFahrenheit()
                    ), $measurements)
                );
            }
            return new Response($raport, 200, [
                'Content-Type' => 'text/csv',
            ]);
        }     
    }
}
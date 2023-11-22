<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\WeatherUtil;
use App\Repository\LocationRepository;
use App\Entity\Location;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather')]
    public function city(string $city, WeatherUtil $util, LocationRepository $Lrepository): Response
    {
        $location = $Lrepository->findByCity($city);
        $measurements = $util->getWeatherForLocation($location);
        
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
    
}

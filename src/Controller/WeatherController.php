<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;
use App\Entity\Location;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather')]
    public function city(string $city, MeasurementRepository $Mrepository, LocationRepository $Lrepository): Response
    {
        $location = $Lrepository->findByCity($city);
        $measurements = $Mrepository->findByLocation($location);
        
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
    
}

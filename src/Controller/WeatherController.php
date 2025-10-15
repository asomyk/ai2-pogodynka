<?php

namespace App\Controller;

use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;
use App\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}/{country?}', name: 'app_weather', requirements: ['id' => '\d+', 'city' => '.+', 'country' => '[A-Za-z]{2}'])]
    public function cityByName(
        string $city,
        ?string $country,
        LocationRepository $locations,
        MeasurementRepository $measurementsRepo
    ): Response {
        $location = $locations->findOneByCityAndCountry($city, $country);

        if (!$location) {
            throw $this->createNotFoundException("Location '{$city}'".($country ? ", {$country}" : '')." not found");
        }

        $measurements = $measurementsRepo->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}

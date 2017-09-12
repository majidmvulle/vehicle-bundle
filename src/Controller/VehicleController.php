<?php

namespace MajidMvulle\Bundle\VehicleBundle\Controller;

use MajidMvulle\Bundle\VehicleBundle\Entity\Make;
use MajidMvulle\Bundle\VehicleBundle\Entity\Model;
use MajidMvulle\Bundle\VehicleBundle\Entity\ModelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as CF;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VehicleController.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class VehicleController extends Controller
{
    /**
     * Gets Vehicle Models.
     *
     * @CF\Route("/makes/{makeId}/models/{year}", name="majidmvulle_vehicle_models", requirements={"makeId": "\d+", "year": "\d{4}"})
     * @CF\Method("GET")
     * @CF\ParamConverter("make", class="MajidMvulleVehicleBundle:Make", options={"mapping": {"makeId"="id"}})
     *
     * @param Make $make
     * @param int  $year
     *
     * @return Response
     */
    public function vehicleModelsAction(Make $make, $year)
    {
        $models = $this->get('doctrine.orm.default_entity_manager')->getRepository(Model::class)->findByMakeYear($make, $year);

        return new Response($this->get('serializer')->serialize($models, 'json'), Response::HTTP_OK, ['content-type' => 'application/json']);
    }

    /**
     * Gets Vehicle ModelTypes.
     *
     * @CF\Route("/models/{modelId}/modelTypes/{year}", name="majidmvulle_vehicle_model_types", requirements={"modelId": "\d+", "year": "\d{4}"})
     * @CF\Method("GET")
     * @CF\ParamConverter("model", class="MajidMvulleVehicleBundle:Model", options={"mapping": {"modelId"="id"}})
     *
     * @param Model $model
     * @param int   $year
     *
     * @return Response
     */
    public function vehicleModelTypesAction(Model $model, $year)
    {
        $modelTypes = $this->get('doctrine.orm.default_entity_manager')->getRepository(ModelType::class)->findByModelYear($model, $year);

        return new Response($this->get('serializer')->serialize($modelTypes, 'json'), Response::HTTP_OK, ['content-type' => 'application/json']);
    }
}

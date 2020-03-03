<?php
/**
 * Created by PhpStorm.
 * User: nikolns
 * Date: 3/7/19
 * Time: 12:58 PM
 */

namespace App\Controller;


use App\Manager\MenuManager;
use Evrinoma\RpnBundle\Calc\RpnCalc;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 *
 * @package App\Controller
 */
class ApiController extends AbstractController
{


//region SECTION: Fields
    /**
     * @var Serializer
     */
    private $serializer;
    /**
     * @var SerializationContext
     */
    private $serializationContext;
//endregion Fields

//region SECTION: Protected
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        if ($this->serializer) {

            $json = $this->serializer->serialize($data, 'json', $this->serializationContext);

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }
//endregion Protected

//region SECTION: Public
    /**
     * @Rest\Put("/internal/menu/create_default", name="api_create_default_menu")
     * @SWG\Put(tags={"menu"})
     * @SWG\Response(response=200,description="Returns the rewards of default generated menu")
     *
     * @param MenuManager $menuManager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function menuCreateDefaultAction(MenuManager $menuManager)
    {
        $menuManager->createDefaultMenu();

        return $this->json(['message' => 'the Menu was generate successFully']);
    }

    /**
     * @Rest\Delete("/internal/menu/delete", name="api_delete_menu")
     * @SWG\Delete(tags={"menu"})
     * @SWG\Response(response=200,description="Returns nothing")
     *
     * @param MenuManager $menuManager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function menuDeleteAction(MenuManager $menuManager)
    {
        $menuManager->deleteDefaultMenu();

        return $this->json(['message' => 'the Menu was delete successFully']);
    }

    /**
     * @Rest\Post("/api/doc/rpn", name="api_rpn")
     * @SWG\Post(tags={"rpn"})
     * @SWG\Response(response=200,description="Returns something")
     * @SWG\Parameter(
     *     name="rpn",
     *     in="query",
     *     type="string",
     *     pattern="\d",
     *     default="((6+10-4)/(1+1*2)-10)%4",
     *     description="record"
     * )
     * @param MenuManager $menuManager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function rpnAction(Request $request, MenuManager $menuManager, RpnCalc $rpnCalc)
    {
        $rpn = $request->get('rpn', '');
        try {
            $result = $rpnCalc->set($rpn)->calc();
        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        return $this->json(['message' => ['formula' => $rpn, 'result' => $result]]);
    }
//endregion Public

//region SECTION: Private
    /**
     * @param $name
     *
     * @return $this
     */
    private function setSerializeGroup($name): self
    {
        if ($name) {
            $this->serializationContext = SerializationContext::create()->setGroups($name);
        }

        return $this;
    }
//endregion Private

//region SECTION: Getters/Setters
    /**
     * @param SerializerInterface $serializer
     *
     * @required
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
//endregion Getters/Setters
}
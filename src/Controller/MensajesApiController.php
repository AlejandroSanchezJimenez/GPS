<?php

namespace App\Controller;

use App\Entity\Mensaje;
use App\Repository\MensajeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MensajesApiController extends AbstractController
{
    #[Route('/mensaje/api/', name: 'app_mensaje_add', methods: ['POST'])]
    public function addMensaje(Request $request, MensajeRepository $mensajerep): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $modo = $data['Modo'];
        $banda = $data['Banda'];
        $user = $data['user'];

        $mensaje = new Mensaje;

        $mensaje->setFechaHoraMensaje(new \DateTime());
        $mensaje->setUsuario($user);
        $mensaje->setBanda($banda);
        $mensaje->setModo($modo);
        $mensaje->setValidado(false);

        $mensajerep->save($mensaje, true);

        return $this->json($data, $status = 201);
    }

    #[Route('/mensaje/api/{id}', name: 'app_mensaje_api_delete', methods: ['DELETE'])]
    public function removeMensaje(Request $request, MensajeRepository $mensajerep, int $id): JsonResponse
    {

        $mensaje = $mensajerep->findByExampleField($id);

        if (!$mensaje) {
            return $this->json('No hay ningun mensaje con ese id', 404);
        } else {
            $mensajerep->remove($mensaje, true);
        }

        return $this->json($status = 201);
    }

    #[Route('/mensaje/api/', name: 'app_mensaje_api_getAll', methods: ['GET', 'HEAD'])]
    public function getMensaje(Request $request, MensajeRepository $mensajerep): JsonResponse
    {
        $mensajes = $mensajerep->findAll();

        if ($mensajerep) {
            foreach ($mensajes as $mensaje) {
                $datos[] = $mensajerep->toArray($mensaje);
            }
        } else {
            return $this->json('No hay mensajes creados',404);
        }
        return $this->json($datos, $status = 201);
    }

    #[Route('/mensaje/api/{id}', name: 'app_mensaje_api_getOne', methods: ['GET', 'HEAD'])]
    public function getMensajeByID(Request $request, MensajeRepository $mensajerep, int $id): JsonResponse
    {
        $mensaje = $mensajerep->findByExampleField($id);

        if (!$mensaje) {
            return $this->json('No hay ningun mensaje con ese id',404);
        } else {
            $datos[] = $mensajerep->toArray($mensaje);
        }

        return $this->json($datos, $status = 201);
    }

    #[Route('/mensaje/api/{id}', name: 'app_mensaje_api_getOne', methods: ['POST'])]
    public function updateMensajeByID(Request $request, MensajeRepository $mensajerep, int $id): JsonResponse
    {
        $mensaje = $mensajerep->findByExampleField($id);

        if (!$mensaje) {
            return $this->json('No hay ningun mensaje con ese id',404);
        } else {
            $data = json_decode($request->getContent(), true);
            $modo = $data['Modo'];
            $banda = $data['Banda'];
            $user = $data['user'];

            $mensaje->setFechaHoraMensaje(new \DateTime());
            $mensaje->setUsuario($user);
            $mensaje->setBanda($banda);
            $mensaje->setModo($modo);
            $mensaje->setValidado(false);

            $mensajerep->save($mensaje, true);

            return $this->json($data, $status = 201);
        }
    }
}

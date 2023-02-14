<?php

namespace App\Controller;

use App\Entity\Mensaje;
use App\Form\MensajesType;
use App\Repository\MensajeRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MensajesController extends AbstractController
{
    private $security;
    private $mensaje;

    public function __construct(Security $security, MensajeRepository $mensaje)
    {
       $this->security = $security;
       $this->mensaje = $mensaje;
    }

    #[Route('/mensajes', name: 'app_mensajes')]
    public function index(Request $request, EntityManagerInterface $em, MensajeRepository $mensajes): Response
    {
        // creates a task object and initializes some data for this example
        $mensaje = new Mensaje;

        $form = $this->createForm(MensajesType::class, $mensaje);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $mensaje = $form->getData();
        
            $mensaje->setFechaHoraMensaje($form->get('FechaHoraMensaje')->getData());
            $mensaje->setUsuario($this->security->getUser());
            $mensaje->setBanda($form->get('Banda')->getData());
            $mensaje->setModo($form->get('Modo')->getData());
            $mensaje->setValidado(false);
                
            $em->persist($mensaje);
            $em->flush();

            return $this->redirectToRoute('app_mensajes');
            }

        return $this->render('mensajes/index.html.twig', [
            'form' => $form->createView(),
            'mensajes' => $mensajes->findByExampleField($this->security->getUser()),
            'mensajesjuez' => $mensajes->findforJuez($this->security->getUser()),
            'mensajerep' => $mensajes
        ]);
    }

    #[Route('/validar', name: 'app_valida')]
    public function validar()
    {
        $this->mensaje->Valida($_GET['id']);
        return $this->redirectToRoute('app_mensajes');
    }

    #[Route('/desvalidar', name: 'app_desvalida')]
    public function desvalidar()
    {
        $this->mensaje->desValida($_GET['id']);
        return $this->redirectToRoute('app_mensajes');
    }
}


<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function newAction(Request $request): Response
    {
        $cliente = new Cliente();

        $form = $this->createForm(ClienteType::class, $cliente);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($cliente);
            $this->em->flush();

            $this->addFlash('success', 'Cliente cadastrado com sucesso!');

            return $this->redirectToRoute('index');
        }

        return $this->renderForm('cliente/new.html.twig', [
            'form' => $form,
        ]);
    }
}

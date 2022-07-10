<?php

namespace App\Controller;

use App\Entity\Fatura;
use App\Entity\Recibo;
use App\Form\CarneType;
use App\Form\ReciboType;
use App\Service\FaturaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReciboController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var FaturaService
     */
    private $faturaService;

    public function __construct(EntityManagerInterface $em, FaturaService $faturaService)
    {
        $this->em = $em;
        $this->faturaService = $faturaService;
    }

    public function newAction(Request $request): Response
    {
        $recibo = new Recibo();

        $form = $this->createForm(ReciboType::class, $recibo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($recibo);
            $this->em->flush();

            $this->faturaService->criarFaturas($recibo);

            $this->addFlash('success', 'Recibo cadastrado com sucesso!');

            return $this->redirectToRoute('index');
        }

        return $this->renderForm('recibo/new.html.twig', [
            'form' => $form,
        ]);
    }

    public function imprimirAction(Request $request): Response
    {
        $form = $this->createForm(CarneType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $this->em->getRepository(Fatura::class);
            $faturas = $repository->findFaturasByCliente($form->get('cliente')->getData());

            return $this->render('imprimir/carne.html.twig', [
                'cliente' => $form->get('cliente')->getData(),
                'faturas' => $faturas,
            ]);
        }

        return $this->renderForm('carne/index.html.twig', [
            'form' => $form,
        ]);
    }
}

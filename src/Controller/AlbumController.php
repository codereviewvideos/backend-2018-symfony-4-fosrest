<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AlbumController
 * @package App\Controller
 * @Rest\RouteResource("Album", pluralize=false)
 */
class AlbumController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        AlbumRepository $albumRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->albumRepository = $albumRepository;
    }

    public function getAction(string $id)
    {

    }


    public function postAction(Request $request)
    {
        $form = $this->createForm(AlbumType::class, new Album());

        $form->submit(
            $request->request->all()
        );

        if (false === $form->isValid()) {
            return $this->view(
                $form
            );
        }

        $this->entityManager->persist($form->getData());
        $this->entityManager->flush();

        return $this->view(
            [
                'status' => 'ok',
            ],
            Response::HTTP_CREATED
        );
    }
}

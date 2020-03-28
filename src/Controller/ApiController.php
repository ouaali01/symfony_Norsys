<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApiController extends AbstractFOSRestController
{


    public function getClientsAction()
    {

        $listclients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $listclients;
    }

    /**
     * @ParamConverter("client", converter="fos_rest.request_body")
     */
    public function postClientAction( Client $client)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();

        return $this->view($client);
    }

        /**
         *  @Route("/api/{name}")
         * @return clients[]
         */
        public function getlistclientAction($name): array
     {
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Client p
            WHERE p.nom > :name
            ORDER BY p.nom ASC'
        )->setParameter('name', $name);

        return $query->getResult();
    }

    public function getClientAction(int $id)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        return $client;
    }
    /**
     * @ParamConverter("client", converter="fos_rest.request_body")
     */
    public function putClientAction(int $id,Client $client)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $oldclient = $this->getDoctrine()->getRepository(Client::class)->find($id);
        if (!$oldclient) {
            return  'No client found for id '.$id;
        }

        $entityManager->persist($client);
        $entityManager->flush();
        return $this->view($client);


    }

    /**
     * @param int $id
     * @return object|string|null
     */
    public function deletClientAction(int $id)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        if (!$client) {
            return  'No client found for id '.$id;
        }
         $entityManager->remove($client);
         $entityManager->flush();
         return $client;
    }

    /**
     * @Route("/api/enabled", methods={"GET"})
     * @return clients[]
     */
    public function getactiveclientAction(): array
    {
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Client p
            WHERE p.enabled = :true
            ORDER BY p.nom ASC'
        );

        return $query->getResult();
    }
}
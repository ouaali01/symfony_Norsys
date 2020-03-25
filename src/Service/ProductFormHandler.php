<?php


namespace App\Service;
use App\Service\CalculPrixTTC;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProductFormHandler
{
      private $em;
      private $calculeprix ;
      public function __construct(CalculPrixTTC $calculeprix ,EntityManagerInterface $em )
       {
           $this->calculeprix= $calculeprix;
           $this->em = $em;
       }

       public function handle(Request $request , $form ){

           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {
               $product=$form->getData();
               $product->setImageURL("https://www.challenge.ma/wp-content/uploads/2017/02/smartphone.jpg");
               $product->setCreateAt(date('d-m-y'));
               if ($form->get('TTC')->getData()) {
                   $prix = $form->get('price')->getData();
                   $prixTTC=$this->calculeprix->getPrixTTC($prix) ;
                   $product->setPrice($prixTTC);
               }
               $this->em->persist($product);
               $this->em->flush();
               return true;

       }else
                return false;
       }
}
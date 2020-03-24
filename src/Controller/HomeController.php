<?php


namespace App\Controller;

use App\Entity\Order;
use App\Entity\Orderdetail;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class HomeController extends AbstractController

{



    /**
     * @Route("/", name="message")
     * @return Response
     * @throws Exception
     */
    public function index() {
        return $this->render('base.html.twig');
    }




    /**
     * @Route("/home", name="home")
     * @return Response
     */
    public function home() {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('home/listproduct.html.twig',array('products' =>$products));
    }




    /**
     * @Route("/add", name="add",  methods={"GET","POST"})
     * @return Response
     * @throws Exception
     */
    public function  save( Request $request ) {
        $entityManager=$this->getDoctrine()->getManager();

        if ($request->getMethod() === 'POST') {

            $name=$request->request->get('name');
            $price=$request->request->get('price');
            $discripton= $request->request->get('description');
            $img="https://www.challenge.ma/wp-content/uploads/2017/02/smartphone.jpg";
            $qen=$request->request->get('quantity');
            $produc = new Product($name,$price,$qen,$discripton,$img);
            $entityManager->persist($produc);
            $entityManager->flush();}
        return $this->render('home/addproduct.html');

    }

    /**
     * @Route("/addcmd", name="addcmd",  methods={"GET","POST"})
     * @return Response
     * @throws Exception
     */
    public function  savecmd( Request $request ) {
        $entityManager=$this->getDoctrine()->getManager();

        if ($request->getMethod() === 'POST') {
             /*($quantity, $product, $prodorder)*/

            $Idproduct=$request->request->get('idproduit');
            $product= $this->getDoctrine()->getRepository(Product::class)->find($Idproduct);
            $qen=$request->request->get('quantity');
            $productorder = new Order();
            $cmd =new Orderdetail($qen,$product,$productorder);
            $entityManager->persist($cmd);
            $entityManager->flush();
        }
        return $this->render('home/addcommand.html.twig');

    }
}
<?php


namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\ProductFormHandler;
use Doctrine\DBAL\Types\IntegerType;
use phpDocumentor\Reflection\File;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
    public function  save(ProductFormHandler $productservice ,Request $request) {
            $product =new Product();
            $form = $this->createForm(ProductType::class, $product);

            if ($productservice->handle($request,$form)){
             return $this->redirectToRoute('home');
             }

          return $this->render('home/addproduct.html.twig', [
            'form' => $form->createView(),
           ]);

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
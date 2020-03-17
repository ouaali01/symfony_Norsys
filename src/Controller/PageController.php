<?php


namespace App\Controller;

use App\Entity\Product;
use Exception;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{


    /**
     * @Route("/about", name="message")
     * @return Response
     * @throws Exception
     */
    public function index() {
        return $this->render('pages/about.html.twig');
    }



    /**
     * @Route("/home", name="message2")
     * @return Response
     * @throws Exception
     */
    public function home() {
/*    private $id;
    private $name;
    private $price;
    private $quantity;
    private $description;
    private $imageUrl;
    private $createAt;
*/
        $p1=new Product(1,"produit 1",2000,6,"smartphone","https://www.challenge.ma/wp-content/uploads/2017/02/smartphone.jpg","2020-03-16");
        $p2=new Product(2,"produit 2",5000,6,"tablet","https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6371/6371050_sd.jpg","2020-03-16");
        $p3=new Product(3,"produit 3",6000,6,"tablet","https://i.dell.com/sites/csimages/Video_Imagery/all/xps_7590_touch.png","2020-03-16");

       $products = array($p1,$p2,$p3);
        return $this->render('pages/home.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @return Response
     * @throws Exception
     */
    public function addp() {
        return $this->render('pages/add.html.twig');
    }

    /**
     * @Route("/about", name="about")
     * @return Response
     * @throws Exception
     */
    public function about() {
        return $this->render('pages/about.html.twig');
    }

}

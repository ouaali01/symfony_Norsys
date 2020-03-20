<?php
namespace App\Controller;
use App\Entity\Product;
use Exception;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageController extends AbstractController
{

    private $session;

    /**
     * PageController constructor.
     * @param $session
     */
    public function __construct(SessionInterface $session)
    {

        $this->session = $session;
    }


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

     */
    public function home() {
        $this->session->start();
        if ($this->session == null) {
            $products = [
                new Product("produit 1",2000,6,"smartphone","https://www.challenge.ma/wp-content/uploads/2017/02/smartphone.jpg"),
                new Product("produit 2",5000,6,"tablet","https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6371/6371050_sd.jpg"),
                new Product("produit 3",6000,6,"tablet","https://i.dell.com/sites/csimages/Video_Imagery/all/xps_7590_touch.png")
            ];
            $this->session->set('product', $products);
        }
        return $this->render('pages/home.html.twig',['productss' =>$this->session->get('product',[])]);
    }

    /**
     * @Route("/list", name="list")
     */
    public function list() {
        $this->session->start();
        $product = $this->session->get('product', []);
        return new Response(var_dump($product));
    }


    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     * @return Response
     * @throws Exception
     */
    public function add( Request $request ) {
        $this->session->start();
        $products =$this->session->get('products', []);
        if ($request->getMethod() === 'POST') {
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $p = new Product($name, $price, $quantity, $description, "https://via.placeholder.com/100");

            array_push($products,$p);
            $this->session->set('products', $products);
        }
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

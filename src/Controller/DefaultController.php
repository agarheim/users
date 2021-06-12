<?php

declare(strict_types=1);

namespace App\Controller;
use App\Helper\UserGenarate;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController  extends AbstractController
{
    /**
     * @var UserService
     */
     private $userService;

    public function __construct( UserService $userService)
    {
         $this->userService = $userService;
    }
       public  $codeCountry = ['380',];

    /**
     * @Route ("/", name="home")
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
//        $birhtday =mktime(0, 0, 0, );
//var_dump((12-rand(1,10)).'-'.(30-rand(2,10)).'-'.(2021-rand(18,40)));

//        $u = new UserGenarate($this->entityManager );
//         $u->generateUser(2000);
        return $this->render('app/home.html.twig');
    }

    /**
     * @Route ("/user/{id}", name="getuser")
     * @return Response
     * @throws \Exception
     */
    public function getUsersById($id)
    {
      //  var_dump($this->userService->getUser($id));
        return new JsonResponse($this->userService->getUserById($id));
    }
}

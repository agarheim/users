<?php

declare(strict_types=1);

namespace App\Controller;
use App\Helper\UserGenarate;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Ramsey\Uuid\v1;

class DefaultController  extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var mixed
     */

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
       public array $codeCountry = ['380',];

    /**
     * @Route ("/", name="home")
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
//        $birhtday =mktime(0, 0, 0, );
//var_dump((12-rand(1,10)).'-'.(30-rand(2,10)).'-'.(2021-rand(18,40)));

        $u = new UserGenarate($this->entityManager );
         $u->generateUser(2000);
        return $this->render('app/home.html.twig');
    }

    public function generateUsers()
    {
        
    }
}

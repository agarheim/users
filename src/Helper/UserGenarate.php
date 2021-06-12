<?php


namespace App\Helper;


use App\Entity\Users;
use App\Entity\UsersPhones;
use Doctrine\ORM\EntityManagerInterface;

class UserGenarate
{
    private  $codeCountry = ['380',];

    private  $codeOperator = ['50', '67', '63', '68'];

    private  $name = ["Харитон","Артемий","Елисей","Александр","Дмитрий","Виктор","Изяслав","Ярослав","Ростислав","Фадей","Богдан","Сергей",
        "Пахом","Вадим","Макар","Марк","Митофан","Остап","Потап","Прохор","Радислав","Андрей","Артем","Олег","Валерий","Виталий","Владимир","Влас",
        "Вячеслав","Геннадий","Георгий","Герман","Глеб","Григорий","Давид","Данила","Дементий","Дмитрий","Денис","Евгений","Евдоким","Егор","Евстафий",
        "Елисей","Емельян","Игорь","Игнатий","Захар","Измаил","Илья","Иннокентий","Иосиф","Карл","Кирилл","Константин","Ян","Якуб","Юрий","Фома",
        "Тимофей","Тимур","Тимур","Тихон","Ульян","Федор"];
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var mixed
     */

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @throws \Exception
     */
    public function generateUser($num)
    {
        if (intval($num)<0 ){
            throw new \RuntimeException('Unable to generate user.');
        }



        for($i=0; $i<=$num; $i++)
        { $user = new Users();
            $user->setName($this->name[mt_rand(0, count($this->name) - 1)]);
            $user->setBirthDay(new \DateTime(date("Y-m-d",  mktime(0, 0, 0, (12-mt_rand(1,10)),(30-mt_rand(2,10)),(2021-mt_rand(18,40))))));
            $k=mt_rand(1,3);
            $index=0;

//            var_dump($user);
            while ($k<=3){
                $phone = new UsersPhones();
                $phone->setCodeCountry($this->codeCountry[0]);
                $phone->setCodeOperator($this->codeOperator[mt_rand(0, count($this->codeOperator) - 1)]);
                $phone->setPhone(mt_rand(1000000, 9999999));
                $phone->setBalance(mt_rand(-10000, +9999));
                $k++;
                $user->addUsersPhone($phone);
                $this->entityManager->persist($phone);
            }

        }


    }


}

<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\UsersPhones;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;



class UserService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UsersRepository $usersRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->usersRepository = $usersRepository;
    }

    public function getUserById($userId): array
    {
        $user = null;

        if ($userId) {
            $user = $this->usersRepository->find($userId);
        }
         $arrPhones = [];
        foreach ($user->getUsersPhones() as $phones):
            $arrPhones[] = '+'.$phones->getCodeCountry().$phones->getCodeOperator().$phones->getPhone();
        endforeach;

        return [
            'name' =>$user->getName(),
            'year_birhtday' => $user->getBirthDay()->format('Y'),
            'phones' => $arrPhones,
        ];
    }

    public function addUser(\stdClass $userItem)
    {
        $user= new Users();

        $user->setName($userItem->name);
        $user->setBirthDay(new \DateTime($userItem->date));



        foreach ($userItem->phones as $phonesItem) {
            $usersPhones = new UsersPhones();

            if (isset ($phonesItem->phoneNumber) && $phonesItem->phoneNumber!=='') {
                $existingItem = $this->processPhone($phonesItem->phoneNumber);
                $usersPhones->setCodeCountry($existingItem[0]);
                $usersPhones->setCodeOperator(intval($existingItem[1]));
                $usersPhones->setPhone(intval($existingItem[2]));
            }

            if (isset($phonesItem->balance) && $phonesItem->balance!=='') {
                $usersPhones->setBalance(intval(($phonesItem->balance*100)));
            }

            $user->addUsersPhone($usersPhones);
            $this->entityManager->persist($usersPhones);
        }

        $this->entityManager->flush();

        return true;
    }

    public function processPhone($phone) {

        $phones = array();
       //clear phone number
        $temp_phone = str_replace(array(' ', '-', '(', ')', '+'), "", $phone);

        //get country code
        $temp_phone = substr($temp_phone, 0,3);
        array_push($phones, $temp_phone);

        //get operator code
        $temp_phone = substr($phone, 4,2);
        array_push($phones, $temp_phone);
        //get number
        $temp_phone = substr($phone,6);
        array_push($phones, $temp_phone);
        return $phones;
    }
//
//    public function save(Order $order, ?User $user = null)
//    {
//        if ($user) {
//            $order->setUser($user);
//        }
//        $this->entityManager->persist($order);
//        $this->entityManager->flush();
//
//        $this->sessions->set(self::SESSION_KEY, $order->getId());
//    }




}
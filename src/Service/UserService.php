<?php


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



//        if (!$order) {
//            $order = new Order();
//        }

        return [
            'name' =>$user->getName(),
            'year_birhtday' => $user->getBirthDay()->format('Y'),
            'phones' => $arrPhones,
        ];
    }

//    public function add(Product $product, int $count, ?User $user): Order
//    {
//        $order = $this->getOrder();
//        $existingItem = null;
//
//        foreach ($order->getItems() as $item) {
//            if ($item->getProduct() === $product) {
//                $existingItem = $item;
//                break;
//            }
//        }
//
//        if ($existingItem) {
//            $newCount = $existingItem->getCount() + $count;
//            $existingItem->setCount($newCount);
//        } else {
//            $existingItem = new OrderItem();
//            $existingItem->setProduct($product);
//            $existingItem->setCount($count);
//            $order->addItem($existingItem);
//        }
//
//        $this->save($order, $user);
//
//        return $order;
//    }
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
//
//    public function deleteItem(OrderItem $item)
//    {
//        $order = $item->getCart();
//        $order->removeItem($item);
//        $this->entityManager->remove($item);
//        $this->save($order);
//    }
//
//    public function makeOrder(Order $order)
//    {
//        $order->setOrderedAt(new \DateTime());
//        $this->save($order);
//        $this->sessions->remove(self::SESSION_KEY);
//        $this->sendAdminOrderMesage($order);
//    }
//
//    private function sendAdminOrderMesage(Order $order)
//    {
//        $message = new TemplatedEmail();
//        $message->to(new Address($this->parametrs->get('orderAdminEmail')));
//        $message->from('noreply@shop.com');
//        $message->subject('Yовый заказ на сайте');
//        $message->htmlTemplate('order/emails/admin.html.twig');
//        $message->context(['order' => $order]);
//        $this->mailer->send($message);
//
//    }



}
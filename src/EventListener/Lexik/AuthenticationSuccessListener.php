<?php

namespace App\EventListener\Lexik;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

class AuthenticationSuccessListener {

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event) {
        $data = $event->getData();
        $user = $event->getUser();
        //dd($user);

        if (!$user instanceof UserInterface) {
            return;
        }
        $data['data'] = array(
            'username' => $user->getUsername(),
            'email'    => $user->getEmail()
            //'role'     => $user->getRole(),
        );

        $event->setData($data);
    }

}
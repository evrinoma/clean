<?php

namespace App\Tests\Functional\Helper;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\SecurityBundle\Model\SecurityModelInterface;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\User\UserInterface;

trait AuthorizationTrait
{
//region SECTION: Fields
    private UserInterface          $user;
//endregion Fields

//region SECTION: Protected
    protected function getAuthorization($container, $client): void
    {
        $em = $this->getEntityManager();

        $this->user = $em->getReference(User::class, 1);

        $jwtTokenGenerator = $container->get('evrinoma.security.token.jwt.generator');
        $jwtTokenGenerator->generate($this->user);
        $cookie = $jwtTokenGenerator->getRefreshTokenCookie();
        $client->getCookieJar()->set(new Cookie($cookie->getName(), $cookie->getValue(), $cookie->getExpiresTime(), $cookie->getPath(), $cookie->getDomain()));

        $client->setServerParameter('HTTP_AUTHORIZATION', ucfirst(mb_strtolower(SecurityModelInterface::BEARER)).' '.$jwtTokenGenerator->getAccessToken());
    }

    protected function getUser(): UserInterface
    {
        return $this->user;
    }

    abstract protected function getEntityManager():EntityManagerInterface;
//endregion Protected

}
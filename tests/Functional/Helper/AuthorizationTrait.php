<?php

namespace App\Tests\Functional\Helper;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\SecurityBundle\Model\SecurityModelInterface;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\User\UserInterface;

trait AuthorizationTrait
{
//region SECTION: Fields
    private UserInterface          $user;
    private EntityManagerInterface $em;
//endregion Fields

//region SECTION: Protected
    protected function getAuthorizationClient(): AbstractBrowser
    {
        $client = static::createClient();

        $container = $client->getContainer();

        $this->em   = $container->get('doctrine.orm.default_entity_manager');
        $this->user = $this->em->getReference(User::class, 1);

        $jwtTokenGenerator = $container->get('evrinoma.security.token.jwt.generator');
        $jwtTokenGenerator->generate($this->user);
        $cookie = $jwtTokenGenerator->getRefreshTokenCookie();
        $client->getCookieJar()->set(new Cookie($cookie->getName(), $cookie->getValue(), $cookie->getExpiresTime(), $cookie->getPath(), $cookie->getDomain()));

        $client->setServerParameter('HTTP_AUTHORIZATION', ucfirst(mb_strtolower(SecurityModelInterface::BEARER)).' '.$jwtTokenGenerator->getAccessToken());

        return $client;
    }

    protected function getUser(): UserInterface
    {
        return $this->user;
    }

    protected function rm(string $class, int $id): void
    {
        $obj = $this->em->getReference($class, $id);
        $this->em->remove($obj);
        $this->em->flush();
    }
//endregion Protected
}
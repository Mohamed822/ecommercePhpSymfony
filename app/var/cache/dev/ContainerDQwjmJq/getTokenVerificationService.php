<?php

namespace ContainerDQwjmJq;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTokenVerificationService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\utils\tokenVerification' shared autowired service.
     *
     * @return \App\utils\tokenVerification
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/utils/tokenVerification.php';

        return $container->services['App\\utils\\tokenVerification'] = new \App\utils\tokenVerification();
    }
}
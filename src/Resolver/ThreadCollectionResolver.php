<?php


namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\QueryCollectionResolverInterface;
use App\Entity\Thread;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;


final class ThreadCollectionResolver implements QueryCollectionResolverInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param iterable<Thread> $collection
     *
     * @return iterable<Thread>
     */
    public function __invoke(iterable $collection, array $context): iterable
    {
        // Query arguments are in $context['args'].

        $threads = [];

        foreach ($collection as $thread) {
            // Do something with the book.
            if($this->security->isGranted('THREAD_READ',$thread)) $threads[] = $thread;
        }

        return $threads;
        //return $collection;
    }
}
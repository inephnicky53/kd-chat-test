<?php


namespace App\Resolver;


use ApiPlatform\Core\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\Message;
use Symfony\Component\Security\Core\Security;


final class MessageMutationResolver implements MutationResolverInterface
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Message|null $item
     *
     * @return Message
     */
    public function __invoke($item, array $context)
    {
        // Mutation input arguments are in $context['args']['input'].

        // Do something with the book.
        // Or fetch the book if it has not been retrieved.

        // The returned item will pe persisted.
        //return null;
        if($item->getSender()->getId()!=$this->security->getUser()->getId())return null;

        return $item;
    }
}
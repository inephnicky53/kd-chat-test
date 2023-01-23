<?php


namespace App\Security\Voter;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class MessageVoter extends Voter
{
    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject): bool
    {
        $supportsAttribute = in_array($attribute, ['MESSAGE_CREATE', 'MESSAGE_READ']);
        $supportsSubject = $subject instanceof Message;

        return $supportsAttribute && $supportsSubject;
    }

    /**
     * @param string $attribute
     * @param Message $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        /**
         * @var $user User
         */
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        switch ($attribute) {
            case 'MESSAGE_CREATE':
                $id = $user->getId();
                if ($this->security->isGranted("ROLE_USER") && $subject->getSender()->getId()===$id) {
                    return true;
                }  // only admins can create books
                break;
            case 'MESSAGE_READ':
                /** ... other autorization rules ... **/
                $id = $user->getId();
                return $this->security->isGranted("ROLE_USER") && $subject->getThread()->getParticipants()->exists(function ($key, $element) use ($id) {
                        return $element->getId() == $id;
                    });
        }

        return false;
    }

}
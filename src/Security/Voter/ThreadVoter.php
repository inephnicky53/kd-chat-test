<?php


namespace App\Security\Voter;

use App\Entity\Thread;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ThreadVoter extends Voter
{
    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject): bool
    {
        $supportsAttribute = in_array($attribute, ['THREAD_CREATE', 'THREAD_READ', 'THREAD_EDIT', 'THREAD_DELETE']);
        $supportsSubject = $subject instanceof Thread;

        return $supportsAttribute && $supportsSubject;
    }

    /**
     * @param string $attribute
     * @param Thread $subject
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
            case 'THREAD_CREATE':
                if ($this->security->isGranted("ROLE_USER")) {
                    return true;
                }  // only admins can create books
                break;
            case 'THREAD_READ':
                /** ... other autorization rules ... **/
                $id = $user->getId();
                return $this->security->isGranted("ROLE_USER") && $subject->getParticipants()->exists(function ($key, $element) use ($id) {
                        return $element->getId() == $id;
                    });
        }

        return false;
    }

}
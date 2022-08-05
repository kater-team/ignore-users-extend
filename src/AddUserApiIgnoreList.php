<?php

namespace Kater\IgnoreUserExtend;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;

class AddUserApiIgnoreList
{

   
    public function __invoke(UserSerializer $serializer, User $user, array $attributes): array
    {
        $actor = $serializer->getActor();
        $attributes["ignore_all"] = $actor->ignoredUsers->contains($user) || $user->ignoredUsers->contains($actor);
        return $attributes;
    }
}

<?php

namespace Kater\IgnoreUserExtend;

use Flarum\Api\Serializer\UserSerializer;
use Flarum\User\User;
use Flarum\Extension\ExtensionManager;
use Kater\IgnoreUserExtend\Model\IgnoreUser;
use Flarum\Settings\SettingsRepositoryInterface;

class AddUserApiIgnoreList
{

   
    public function __invoke(UserSerializer $serializer, User $user, array $attributes): array
    {
        $actor = $serializer->getActor();
        $attributes["ignore_all"] = $actor->ignoredUsers->contains($user) || $user->ignoredUsers->contains($actor);
        return $attributes;
    }
}

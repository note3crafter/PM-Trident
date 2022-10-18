<?php

declare(strict_types = 1);

namespace TheNote;

use TheNote\item\ItemManager;
use TheNote\entity\EntityManager;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    public function onLoad() :void
    {
        ItemManager::init();
        EntityManager::init();
    }
}

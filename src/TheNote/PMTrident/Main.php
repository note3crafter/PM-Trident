<?php

declare(strict_types = 1);

namespace TheNote\PMTrident;

use TheNote\PMTrident\item\ItemManager;
use TheNote\PMTrident\entity\EntityManager;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    public function onLoad() :void
    {
        ItemManager::init();
        EntityManager::init();
    }
}

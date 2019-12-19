<?php

declare(strict_types = 1);

namespace TheNote;

use TheNote\item\ItemManager;
use TheNote\entity\EntityManager;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{

    public static function getInstance(): Main
    {
        return self::$instance;
    }
    public function onLoad()
    {
        ItemManager::init();
        EntityManager::init();
    }
}

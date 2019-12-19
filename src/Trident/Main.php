<?php

declare(strict_types = 1);

namespace Trident;

use pocketmine\plugin\PluginLogger;
use Trident\item\ItemManager;
use Trident\entity\EntityManager;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{

    public static function getInstance(): Main
    {
        return self::$instance;
    }
    public static function getPluginLogger(): PluginLogger{ // 2 lazy (#blameLarry)
        return self::$instance->getLogger();
    }

    public function onLoad()
    {
        $this->getLogger()->info("§aThis plugin is for PMMP and Altay only. It is meant to extend PMMP's and Altay's functionality.");
        ItemManager::init();
        EntityManager::init();
    }
}

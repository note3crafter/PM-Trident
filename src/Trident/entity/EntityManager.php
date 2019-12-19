<?php

declare(strict_types = 1);

namespace Trident\entity;

use Trident\entity\projectile\ThrownTrident;
use Trident\Main;
use pocketmine\entity\Entity;

class EntityManager extends Entity {
	public static function init(): void{
		self::registerEntity(ThrownTrident::class, true, ['Trident', 'minecraft:trident']);
	}
}

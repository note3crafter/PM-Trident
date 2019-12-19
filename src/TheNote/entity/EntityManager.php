<?php

declare(strict_types = 1);

namespace TheNote\entity;

use TheNote\entity\projectile\ThrownTrident;
use TheNote\Main;
use pocketmine\entity\Entity;

class EntityManager extends Entity {
	public static function init(): void{
		self::registerEntity(ThrownTrident::class, true, ['Trident', 'minecraft:trident']);
	}
}

<?php

declare(strict_types = 1);

namespace TheNote\PMTrident\entity;

use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\data\SavedDataLoadingException;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\World;
use TheNote\PMTrident\entity\projectile\ThrownTrident;

class EntityManager {
    public static function init(): void
    {
        EntityFactory::getInstance()->register(ThrownTrident::class, function (World $world, CompoundTag $nbt): ThrownTrident {
            $itemTag = $nbt->getCompoundTag("Trident");
            if ($itemTag === null) {
                throw new SavedDataLoadingException("Expected \"Trident\" NBT tag not found");
            }

            $item = Item::nbtDeserialize($itemTag);
            if($item->isNull()){
                throw new SavedDataLoadingException("Trident Item is invalid");
            }
            return new ThrownTrident(EntityDataHelper::parseLocation($nbt, $world), $item, null, $nbt);
        }, ['Trident', 'ThrownTrident', 'minecraft:trident' , 'minecraft:trown_trident'], EntityLegacyIds::TRIDENT);
    }
}

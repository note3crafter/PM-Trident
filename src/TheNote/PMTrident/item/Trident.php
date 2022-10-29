<?php

declare(strict_types = 1);

namespace TheNote\PMTrident\item;

use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\entity\Location;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\item\ItemUseResult;
use pocketmine\item\Releasable;
use pocketmine\item\Tool;
use pocketmine\player\Player;
use TheNote\PMTrident\entity\projectile\ThrownTrident;
use TheNote\PMTrident\sounds\TridentThrowSound;

class Trident extends Tool implements Releasable
{

    public function getMaxDurability(): int
    {
        return 250;
    }

    public function onReleaseUsing(Player $player): ItemUseResult
    {
        $location = $player->getLocation();

        $diff = $player->getItemUseDuration();
        $p = $diff / 20;
        $baseForce = min((($p ** 2) + $p * 2) / 3, 1) * 3;
        if ($baseForce < 0.9 || $diff < 8) {
            return ItemUseResult::FAIL();
        }

        $entity = new ThrownTrident(Location::fromObject(
            $player->getEyePos(),
            $player->getWorld(),
            ($location->yaw > 180 ? 360 : 0) - $location->yaw,
            -$location->pitch
        ), $this, $player);
        $entity->setMotion($player->getDirectionVector()->multiply($baseForce));

        $ev = new ProjectileLaunchEvent($entity);
        $ev->call();
        if ($ev->isCancelled()) {
            $ev->getEntity()->flagForDespawn();
            return ItemUseResult::FAIL();
        }
        $ev->getEntity()->spawnToAll();
        $location->getWorld()->addSound($location, new TridentThrowSound());


        if ($player->hasFiniteResources()) {
            $item = $entity->getItem();
            $item->applyDamage(1);
            $entity->setItem($item);
            $this->pop();
        } else {
            $entity->setPickupMode(ThrownTrident::PICKUP_NONE);
        }
        return ItemUseResult::SUCCESS();
    }

    public function getAttackPoints(): int
    {
        return 8;
    }

    public function onDestroyBlock(Block $block): bool
    {
        if(!$block->getBreakInfo()->breaksInstantly()){
            return $this->applyDamage(2);
        }
        return false;
    }

    public function onAttackEntity(Entity $victim): bool
    {
        return $this->applyDamage(1);
    }
    public function canStartUsingItem(Player $player) : bool{
        return true;
    }
}

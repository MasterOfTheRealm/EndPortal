<?php

namespace EndPortal;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\level\Position;
use pocketmine\utils\Config;

class EndPortal extends PluginBase implements Listener{

    public function onEnable(){
		$this->saveResource("config.yml");
        $this->getLogger()->info("EndPortal By MasterOfTheRealm Has Been Enabled");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable(){
        $this->getLogger()->info("EndPortal Has Been Deactivated");
    }
	
	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		$endpor = $event->getPlayer()->getLevel()->getBlock($event->getPlayer()->floor());
		$cfg = $this->getConfig()->getAll();
		
		if($endpor->getId() === $cfg["Portal-block"]){
			
			if($player->getLevel()->getName() === $cfg["default-world-name"]){
		        $player->teleport(new Position($cfg["XCoord-Ender"], $cfg["YCoord-Ender"], $cfg["ZCoord-Ender"], $this->getServer()->getLevelByName($cfg["ender-world-name"])));
				return true;
			}
			
			if($player->getLevel()->getName() === $cfg["ender-world-name"]){
				$player->teleport(new Position($cfg["XCoord-Default"], $cfg["YCoord-Default"], $cfg["ZCoord-Default"], $this->getServer()->getLevelByName($cfg["default-world-name"])));
				return true;
			}
		}
	}
}
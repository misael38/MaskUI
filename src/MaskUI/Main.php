<?php

namespace MaskUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use MaskUI\Main;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("§7[§eMaskUI§7] §aEnable Plugin...");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§7[§eMaskUI§7] §cPlease install FormAPI Plugin, §4disabling plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "mask":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§7This command can't be used here. Sorry!");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->sendMessage("§eMaskUI§7>> §aYour Mask Has Been Changed To §fSkeleton!");
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 0, 1));
	                $sender->addTitle("§6You Received", "§fSkeleton §eMask");
						break;
					case 1:
					$sender->sendMessage("§eMaskUI§7>> §aYour Mask Has Been Changed To §0Wither Skeleton!");
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 1, 1));
	                $sender->addTitle("§6You Received", "§0Wither Skeleton §eMask");
						break;
					case 2:
					$sender->sendMessage("§eMaskUI§7>> §aYour Mask Has Been Changed To §2Zombie!");
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 2, 1));
	                $sender->addTitle("§6You Received", "§2Zombie §eMask");
					    break;
					case 3:
					$sender->sendMessage("§eMaskUI§7>> §aYour Mask Has Been Changed To Creeper!");
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 4, 1));
	                $sender->addTitle("§6You Received", "§aCreeper §eMask");
					    break;
					case 4:
					$sender->sendMessage("§eMaskUI§7>> §6Your Mask Has Been Changed To §4Dragon!");
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 5, 1));
	                $sender->addTitle("§6You Received", "§4Dragon §eMask");
					    break;
                    case 5:
                        break;
            }
        });
        $form->setTitle("§l§eMasks");
        $form->setContent("§7Please Select Your Favorite §eMask \n§7Note: Clear your §l§carmor§r before choosing a §eMask \n§b All FREE");
        $form->addButton("§fSkeleton\n §l§aActivated", 0);
        $form->addButton("§0Wither Skeleton\n §l§aActivated", 1);
        $form->addButton("§2Zombie\n §l§aActivated", 2);
        $form->addButton("§aCreeper\n §l§aActivated", 3);
        $form->addButton("§4Dragon\n §l§aActivated", 4);
	$form->addButton("§l§cExit", 5);
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("- [MaskUI] Disabled Plugin!");
    }
}

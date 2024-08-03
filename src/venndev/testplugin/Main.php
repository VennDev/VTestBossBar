<?php

declare(strict_types=1);

namespace venndev\testplugin;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use venndev\vbossbar\VAnimationBossBar;
use venndev\vbossbar\VBarColor;
use venndev\vbossbar\VBossBar;
use Throwable;

final class Main extends PluginBase implements Listener
{

    private VBossBar $bossBar;

    protected function onEnable(): void
    {
        $this->bossBar = new VBossBar(true);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        // Animate the boss bar mode ascending
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            VAnimationBossBar::ascending($this->getBossBar(), 1, 100, 1, function ($percentage, $bossBar) {
                $this->getBossBar()->setTitle("TestPlugin BossBar " . $percentage . "%");
            });
        }), 20);

        // Animate the boss bar mode descending [If you want to use this, you just need to uncomment the code below]
        /*$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            VAnimationBossBar::descending($this->getBossBar(), 100, 1, 1, function ($percentage, $bossBar) {
                $this->getBossBar()->setTitle("TestPlugin BossBar " . $percentage . "%");
            });
        }), 20);*/

        // Animate the boss bar mode pulse [If you want to use this, you just need to uncomment the code below]
        /*$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            VAnimationBossBar::pulse($this->getBossBar(), 1, 100, 1, function ($percentage, $bossBar) {
                $this->getBossBar()->setTitle("TestPlugin BossBar " . $percentage . "%");
            });
        }), 20);*/

        // Animate the boss bar mode cycleColor [If you want to use this, you just need to uncomment the code below]
        /*$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            VAnimationBossBar::cycleColor($this->getBossBar(), [
                VBarColor::RED,
                VBarColor::GREEN,
                VBarColor::BLUE,
                VBarColor::YELLOW,
                VBarColor::PURPLE,
                VBarColor::REBECCA_PURPLE,
                VBarColor::WHITE
            ], function ($color, $bossBar) {
                $this->getBossBar()->setTitle("TestPlugin BossBar " . VBarColor::getNameByColor($color));
            });
        }), 20);*/
    }

    public function getBossBar(): VBossBar
    {
        return $this->bossBar;
    }

    /**
     * @throws Throwable
     */
    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $this->getBossBar()->addPlayer($player);
    }

}
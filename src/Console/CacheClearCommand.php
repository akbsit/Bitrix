<?php
/**
 * Appointment: Очистка кеша
 * File: CacheClearCommand.php
 * Version: 0.0.1
 * Author: Roman Shvikov
 **/

namespace Falbar\Bitrix\Console;

use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CacheClearCommand
 * @package Falbar\Bitrix\Console
 */
class CacheClearCommand extends CacheSizeCommand
{
    /**
     * @return bool
     */
    protected function configure()
    {
        $this->setName('bitrix:cache:clear')
            ->setDescription('Clear cache.');

        return false;
    }

    /**
     * @param InputInterface $oInput
     * @param OutputInterface $oOutput
     * @return bool
     */
    protected function execute(InputInterface $oInput, OutputInterface $oOutput)
    {
        foreach ($this->arDirectories as $sDirectory) {
            $arCount = $this->countSize($_SERVER['DOCUMENT_ROOT'] . $sDirectory);
            $arCount['size'] = round($arCount['size'] / 1048576, 2);
            $iTimeSeconds = $this->clear($sDirectory);

            $oOutput->writeln([
                '<info>Directory: ' . $sDirectory . '</info>',
                '===============================',
                '<comment>Count files: ' . $arCount['file'] . '</comment>',
                '<comment>Size: ' . $arCount['size'] . ' Mb</comment>',
                '<comment>Clear status: ' . ($iTimeSeconds > -1 ? 'success' : '<error>error</error>') . '</comment>',
                '<comment>Time for cleaning: ' . $iTimeSeconds . ' s</comment>',
                ' '
            ]);
        }

        return false;
    }

    /**
     * @param $sDirectory
     * @return int
     */
    protected function clear($sDirectory): int
    {
        if (in_array($sDirectory, $this->arDirectories) !== false) {
            $iTime = time();
            DeleteDirFilesEx($sDirectory);

            return time() - $iTime;
        }

        return -1;
    }
}
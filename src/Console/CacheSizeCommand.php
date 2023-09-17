<?php namespace Akbsit\Bitrix\Console;

use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CacheSizeCommand
 * @package Akbsit\Bitrix\Console
 */
class CacheSizeCommand extends Command
{
    /**
     * @var array
     */
    protected $arDirectories = [
        '/bitrix/cache/',
        '/bitrix/managed_cache/',
        '/upload/resize_cache/'
    ];

    /**
     * @return bool
     */
    protected function configure()
    {
        $this->setName('bitrix:cache:size')
            ->setDescription('Return cache size.');

        return false;
    }

    /**
     * @param InputInterface $oInput
     * @param OutputInterface $oOutput
     * @return bool
     */
    protected function execute(InputInterface $oInput, OutputInterface $oOutput)
    {
        $iCountFile = 0;
        $iCountSize = 0;

        foreach ($this->arDirectories as $sDirectory) {
            $arCount = $this->countSize($_SERVER['DOCUMENT_ROOT'] . $sDirectory);
            $iCountFile += $arCount['file'];
            $iCountSize += $arCount['size'];

            $arCount['size'] = round($arCount['size'] / 1048576, 2);

            $oOutput->writeln([
                '<info>Directory: ' . $sDirectory . '</info>',
                '===============================',
                '<comment>Count files: ' . $arCount['file'] . '</comment>',
                '<comment>Size: ' . $arCount['size'] . ' Mb</comment>',
                ' '
            ]);
        }

        $oOutput->writeln([
            '<info>All cache</info>',
            '===============================',
            '<comment>Count files: ' . $iCountFile . '</comment>',
            '<comment>Size: ' . round($iCountSize / 1048576, 2) . ' Mb</comment>',
            ' '
        ]);

        return false;
    }

    /**
     * @param $sDirectory
     * @return array
     */
    protected function countSize($sDirectory): array
    {
        $arCount = ['file' => 0, 'size' => 0];

        foreach (scandir($sDirectory) as $sFile) {
            if ($sFile !== '.' && $sFile !== '..') {
                if (is_dir($sDirectory . $sFile)) {
                    $inner = $this->countSize($sDirectory . $sFile . '/');

                    $arCount['file'] += $inner['file'];
                    $arCount['size'] += $inner['size'];
                } else {
                    $arCount['file']++;
                    $arCount['size'] += filesize($sDirectory . $sFile);
                }
            }
        }

        return $arCount;
    }
}

<?php
/**
 * Appointment: Создание компонента
 * File: CreateComponentCommand.php
 * Version: 0.0.1
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\Console;

use \Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Command\Command;
use \Bitrix\Main\IO\Directory;
use \Bitrix\Main\IO\File;
use \Bitrix\Main\Loader;

/**
 * Class CreateComponentCommand
 * @package Falbar\Bitrix\Console
 */
class CreateComponentCommand extends Command
{
    /**
     * @return bool
     */
    protected function configure()
    {
        $this->setName('bitrix:create:component')
            ->setDescription('Create bitrix component.')
            ->addArgument('namespace', InputArgument::REQUIRED, 'Component namespace.')
            ->addArgument('name', InputArgument::REQUIRED, 'Component name.');

        return false;
    }

    /**
     * @param InputInterface $oInput
     * @param OutputInterface $oOutput
     * @return bool
     */
    protected function execute(InputInterface $oInput, OutputInterface $oOutput)
    {
        $sNameSpace = $oInput->getArgument('namespace');
        $sName = $oInput->getArgument('name');

        try {
            if (!$sComponentsPath = Loader::getLocal('components')) {
                throw new \Exception('Folder "components" not found');
            }

            $sNameSpacePath = $sComponentsPath . '/' . $sNameSpace;
            $sNamePath = $sNameSpacePath . '/' . $sName;
            $sComponentTemplatePath = dirname(__FILE__, 3) . '/templates/component';

            if (!is_dir($sNameSpacePath)) {
                Directory::createDirectory($sNameSpacePath);
            }

            if (is_dir($sNamePath)) {
                throw new \Exception('Component "' . $sName . '" is already created');
            }

            Directory::createDirectory($sNamePath);

            CopyDirFiles($sComponentTemplatePath, $sNamePath, true, true);

            if ($arTemplatesPath = $this->getTemplateDistFiles($sNamePath)) {
                $sRootNameSpace = ucfirst($sNameSpace);
                $sComponentNameSpace = $this->getComponentNameSpaceByName($sName);

                foreach ($arTemplatesPath as $sFilePath) {
                    $sNewFilePath = rtrim($sFilePath, '.dist');
                    $sNewFile = str_replace([
                        '{{ COMPONENT_NAMESPACE }}',
                        '{{ COMPONENT_NAME }}',
                        '{{ ROOT_NAMESPACE }}',
                        '{{ COMPONENT_CLASS_NAME }}'
                    ], [
                        $sNameSpace,
                        $sName,
                        $sRootNameSpace,
                        $sComponentNameSpace
                    ], File::getFileContents($sFilePath));

                    File::putFileContents($sNewFilePath, $sNewFile);
                    File::deleteFile($sFilePath);
                }

                $oOutput->writeln('
Component "' . $sNameSpace . ':' . $sName . '" created
' . $sNamePath . '
Code to include:
$APPLICATION->IncludeComponent(
    \'' . $sNameSpace . ':' . $sName . '\',
    \'\',
    []
);
                ');
            } else {
                Directory::deleteDirectory($sNamePath);
                $oOutput->writeln('Files were not copied, the component "' . $sName . '" folder was deleted');
            }
        } catch (\Exception $e) {
            $oOutput->writeln($e->getMessage());
        }

        return false;
    }

    /**
     * @param string $sPath
     * @return array
     */
    private function getTemplateDistFiles($sPath)
    {
        $arResult = [];

        if ($sPath && Directory::isDirectoryExists($sPath)) {
            $oDirectory = new \DirectoryIterator($sPath);

            /**
             * @var \SplFileInfo $oFile
             */
            foreach ($oDirectory as $oFile) {
                if ($oFile->isDot()) {
                    continue;
                }

                if ($oFile->isFile() && $oFile->getExtension() === 'dist') {
                    $arResult[] = $oFile->getPathname();
                }

                if ($oFile->isDir()) {
                    $arFiles = $this->getTemplateDistFiles($oFile->getPathname());
                    $arResult = array_merge($arResult, $arFiles);
                }
            }
        }

        return $arResult;
    }

    /**
     * @param string $sName
     * @return string
     */
    private function getComponentNameSpaceByName($sName)
    {
        $sResult = '';

        if ($sName) {
            foreach (explode('.', $sName) as $sItem) {
                $sResult .= ucfirst($sItem);
            }
        }

        return $sResult;
    }
}
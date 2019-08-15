<?php
/**
 * created: 2019
 *
 * @category  XXXXXXX
 * @package   Ayaline
 * @author    aYaline Magento <support.magento-shop@ayaline.com>
 * @copyright 2019 - aYaline Magento
 * @license   aYaline - http://shop.ayaline.com/magento/fr/conditions-generales-de-vente.html
 * @link      http://shop.ayaline.com/magento/fr/conditions-generales-de-vente.html
 */

namespace PHPAISS\Jobs\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Sayhello extends Command
{
    /**
     * command name
     */
    const COMMAND_NAME = 'jobs:sayhello';

    /**
     * Success message
     */
    const DESCRIPTION = "Template hints enabled.";

    /**
     * Options name
     */
    const OPTIONS_NAME = 'name';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $options = [
            new InputOption(
                self::OPTIONS_NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName(self::COMMAND_NAME)
             ->setDescription(self::DESCRIPTION)
             ->setDefinition($options);

        parent::configure();
    }

    /**
     * {@inheritdoc}
     * @throws \InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($name = $input->getOption(self::OPTIONS_NAME)) {
            $output->writeln('<info>' . 'Hello ' . $name . '</info>');
        } else {
            $output->writeln('<comment>' . 'Hello World !' . '</comment>');
        }
    }
}

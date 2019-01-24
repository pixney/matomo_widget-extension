<?php

namespace Pixney\MatomoWidgetExtension;

use Pixney\MatomoWidgetExtension\Command\LoadItems;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;

/**
 * Class MatomoWidgetExtension
 *
 *  @author Pixney AB <hello@pixney.com>
 *  @author William Åström <william@pixney.com>
 *
 *  @link https://pixney.com
 */
class MatomoWidgetExtension extends WidgetExtension
{
    /**
     * This extension provides...
     *
     * This should contain the dot namespace
     * of the addon this extension is for followed
     * by the purpose.variation of the extension.
     *
     * For example anomaly.module.store::gateway.stripe
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.dashboard::widget.matomo';

    /**
     * Load the widget data.
     *
     * @param WidgetInterface $widget
     */
    protected function load(WidgetInterface $widget)
    {
        $this->dispatch(new LoadItems($widget));
    }
}

<?php

namespace Pixney\MatomoWidgetExtension\Command;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;

/**
 * Class LoadItems
 *
 *  @author Pixney AB <hello@pixney.com>
 *  @author William Åström <william@pixney.com>
 *
 *  @link https://pixney.com
 */
class LoadItems
{
    use DispatchesJobs;

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new LoadItems instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the widget data.
     *
     * @param \SimplePie                       $rss
     * @param Repository                       $cache
     * @param ConfigurationRepositoryInterface $configuration
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        $VisitsSummary = [
            'title'=> 'Visits Summary last 52 weeks',
            'src'  => $this->dispatch(new MakeVisitsSummaryPath($this->widget->getId())),
        ];
        $DeviceDetection = [
            'title'=> 'Device Detection',
            'src'  => $this->dispatch(new MakeDeviceDetectionPath($this->widget->getId()))
        ];

        $items =  [$VisitsSummary, $DeviceDetection];

        $this->widget->addData('items', $items);
    }
}

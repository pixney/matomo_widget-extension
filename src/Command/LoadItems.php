<?php

namespace Pixney\MatomoWidgetExtension\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;

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
     * Undocumented function
     *
     * @return void
     */
    public function handle()
    {
        $VisitsSummary = [
            'title'=> 'Visits Summary',
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

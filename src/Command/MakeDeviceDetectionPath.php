<?php

namespace Pixney\MatomoWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;

/**
 * Class MakeDeviceDetectionPath
 *
 *  @author Pixney AB <hello@pixney.com>
 *  @author William Åström <william@pixney.com>
 *
 *  @link https://pixney.com
 */

class MakeDeviceDetectionPath
{
    /**
    * Period
    *
    * day returns data for a given day.
    * week returns data for the week that contains the specified 'date'
    * month returns data for the month that contains the specified 'date'
    * year returns data for the year that contains the specified 'date'
    * range returns data for the specified 'date' range.
    */
    protected $period = 'month';

    /**
    * Date
    *
    * Standard format: YYYY-MM-DD
    * Magic keyword : today, yesterday
    *
    * Range of Dates
    *  lastX       for the last X periods including today (eg &date=last10&period=day would return an
    *              entry for each of the last 10 days including today). This is relative to the website timezone.
    *  previousX   returns the last X periods before today (eg. &date=previous52&period=week
    *              will return an entry for each of the 52 weeks before this week).
    *              This is relative to the website timezone.
    * YYYY-MM-DD,YYYY-MM-DD for every period (day, week, month or year) in the date range
    */
    protected $date ='today';
    protected $baseUrl;
    protected $tokenAuth;
    protected $idSite;

    public function __construct($widgetId)
    {
        $this->widgetId       = $widgetId;

        $configuration        = app(ConfigurationRepositoryInterface::class);
        $this->baseUrl        = $configuration->value('pixney.extension.matomo_widget::base_url', $this->widgetId);
        $this->tokenAuth      = $configuration->value('pixney.extension.matomo_widget::api_key', $this->widgetId);
        $this->idSite         = $configuration->value('pixney.extension.matomo_widget::id_site', $this->widgetId, '1');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function handle()
    {
        $method     = 'ImageGraph.get';
        $apiModule  ='DevicesDetection';
        $apiAction  ='getBrowsers';
        $graphType  ='horizontalBar';
        $width      ='800';
        $height     ='500';

        $url = $this->baseUrl;
        $url .= '/?module=API';
        $url .= "&method={$method}";
        $url .= "&idSite={$this->idSite}";
        $url .= "&apiModule={$apiModule}";
        $url .= "&apiAction={$apiAction}";
        $url .= "&token_auth={$this->tokenAuth}";
        $url .= "&graphType={$graphType}";
        $url .= "&period={$this->period}";
        $url .= "&date={$this->date}";
        $url .= "&width={$width}";
        $url .= "&height={$height}";

        return $url;
    }
}

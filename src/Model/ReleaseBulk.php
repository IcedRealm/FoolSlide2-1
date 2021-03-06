<?php

namespace Foolz\Foolslide\Model;

class ReleaseBulk implements \JsonSerializable
{
    /**
     * @var SeriesData
     */
    public $series = null;

    /**
     * @var ReleaseData
     */
    public $release = null;

    /**
     * @var PageData[]|null
     */
    public $page_array = null;

    /**
     * @param SeriesData $series
     * @param ReleaseData $release
     * @param PageData[]|null $page_array
     * @return SeriesBulk
     */
    public static function forge(SeriesData $series, ReleaseData $release, $page_array = null)
    {
        $new = new static();
        $new->series = $series;
        $new->release = $release;
        $new->page_array = $page_array;

        return $new;
    }

    /**
     * Implements \JsonSerializable interface
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $array = [
            'series' => $this->series->export(),
            'release'=> $this->release->export()
        ];

        if ($this->page_array !== null) {
            $array['pages'] = [];

            foreach ($this->page_array as $page) {
                $array['pages'][] = $page->export();
            }
        }
        return $array;
    }

}
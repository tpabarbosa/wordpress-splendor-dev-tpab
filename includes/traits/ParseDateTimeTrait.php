<?php

namespace SplendorDevTpab\Traits;

trait ParseDateTimeTrait
{

    /**
    * The date to parsed.
    *
    * @since    1.0.0
    * @var      \DateTimeImmutable    $date    The date
    */
    protected $date = null;

    /**
    * Parses the date to given format.
    *
    * @since    1.0.0
    * @param    string    $format    The format to parse the date.
    * @return   string    The date parsed.
    */
    private function parse_date(string $format)
    {
        if ($this->date) {
            return $this->date->format($format);
        }
        return current_datetime()->format($format);
    }

    /**
    * Sets a date to be parsed.
    *
    * @since    1.0.0
    * @param    \DateTimeImmutable    $date    The date.
    */
    public function set_datetime(\DateTimeImmutable $date)
    {
        $this->date = $date;
    }
}
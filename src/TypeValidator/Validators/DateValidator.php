<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;


use DateTime;

class DateValidator extends Base
{
    public function is_valid(): bool
    {
        return $this
            ->validateDate($this->value, config('ventriloquist.defaults.provided_date', 'Y-m-d H:i:s'));
    }

    private function validateDate($date, $format)
    {
        $dateParsed = DateTime::createFromFormat($format, $date);
        return $dateParsed && $dateParsed->format($format) == $date;
    }

}
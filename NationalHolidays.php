<?php

class NationalHolidays
{
    const PRETTY_FORMAT = 'l, F j, Y';

    public static function get(): array
    {
        return [
            'new_years_day' => [
                'name' => 'New Year\'s day',
                'date' => '01-01',
            ],
            'day_after_new_years_day' => [
                'name' => 'Day after New Year\'s day',
                'date' => '02-01',
            ],
            'unification_day' => [
                'name' => 'Unification day',
                'date' => '24-01',
            ],
            'orthodox_good_friday' => [
                'name' => 'Orthodox Good Friday',
                'date' => null,
            ],
            'orthodox_easter_day' => [
                'name' => 'Orthodox Easter day',
                'date' => null,
            ],
            'orthodox_easter_monday' => [
                'name' => 'Orthodox Easter monday',
                'date' => null,
            ],
            'labour_day' => [
                'name' => 'Labour day',
                'date' => '01-05',
            ],
            'international_childrens_day' => [
                'name' => 'International Children\'s day',
                'date' => '01-06',
            ],
            'orthodox_pentecost' => [
                'name' => 'Orthodox Pentecost',
                'date' => null,
            ],
            'descent_of_the_holy_spirit' => [
                'name' => 'Descent of the Holy Spirit',
                'date' => null,
            ],
            'st_marys_day' => [
                'name' => 'St. Mary\'s Day',
                'date' => '15-08',
            ],
            'st_andrews_day' => [
                'name' => 'St. Andrew\'s Day',
                'date' => '30-11',
            ],
            'national_day_of_romania' => [
                'name' => 'Nationald Day of Romania',
                'date' => '01-12',
            ],
            'christmas_day' => [
                'name' => 'Christmas Day',
                'date' => '25-12',
            ],
            'second_day_of_christmas' => [
                'name' => 'Second Day of Christmas',
                'date' => '26-12',
            ],
        ];
    }

    public static function generate(int $year): array
    {
        $nationalHolidays = self::get();

        foreach ($nationalHolidays as &$nationalHoliday) {
            if ($nationalHoliday['date'] === null) {
                continue;
            }

            $nationalHoliday['date'] = DateTime::createFromFormat('d-m-Y', $nationalHoliday['date'] . '-' . $year)
                ->format(self::PRETTY_FORMAT);
        }

        $easterDate = (new DateTime())->setTimezone(new DateTimeZone('Europe/Bucharest'))
            ->setTimestamp(easter_date($year, CAL_JULIAN));

        $nationalHolidays['orthodox_good_friday']['date'] = (clone $easterDate)->modify('-2 days')
            ->format(self::PRETTY_FORMAT);
        $nationalHolidays['orthodox_easter_day']['date'] = (clone $easterDate)->format(self::PRETTY_FORMAT);
        $nationalHolidays['orthodox_easter_monday']['date'] = (clone $easterDate)->modify('+1 days')
            ->format(self::PRETTY_FORMAT);
        $nationalHolidays['orthodox_pentecost']['date'] = (clone $easterDate)->modify('+35 days')
            ->format(self::PRETTY_FORMAT);
        $nationalHolidays['descent_of_the_holy_spirit']['date'] = (clone $easterDate)->modify('+36 days')
            ->format(self::PRETTY_FORMAT);

        return $nationalHolidays;
    }
}

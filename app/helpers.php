<?php
function convertTimestampToProperTimezone(string $timestamp): string
{
    return \Carbon\Carbon::createFromTimeString($timestamp)
        ->timezone(auth()->user()->timezone)
        ->format(config('app.date_format'));
}
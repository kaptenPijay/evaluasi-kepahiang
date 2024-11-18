<?php
function maxTriWulan(array $data, $target): bool
{
    return array_sum($data) > $target;
}
function sumTriWulan(array $data, $target): bool
{
    return array_sum($data) != $target;
}

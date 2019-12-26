<?php

function print_value($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_numeric($value)) {
        return $value;
    }
    if (is_object($value)) {
        $value = json_encode($value);
    }
    return "'" . addslashes($value) . "'";
}

function print_array(array $array = [], $level = 1, $open = true)
{
    $content = "";
    if ($open) {
        $content .= str_repeat(' ', 4 * ($level - 1)) . "[\n";
    }
    foreach ($array as $key => $value) {
        $content .= str_repeat(' ', 4 * $level) . (preg_match('/^[1-9][0-9]*$|^0$/', $key) ? $key : "'" . addslashes($key) . "'") . ' => ';
        if (is_array($value)) {
            $content .= "[\n";
            $content .= print_array($value, $level + 1, false);
        } else {
            $content .= print_value($value);
            $content .= ",\n";
        }
    }
    $content .= str_repeat(' ', 4 * ($level - 1)) . "]" . ($level === 1 ? ';' : ',') . "\n";
    return $content;
}

<?php

function print_array(array $array = [], $level = 1, $open = true)
{
    $content = "";
    if ($open) {
        $content .= str_repeat(' ', 4 * ($level - 1))."[\n";
    }
    foreach ($array as $key => $value) {
        $content .= str_repeat(' ', 4 * $level)."'$key'".' => ';
        if (is_array($value)) {
            $content .= "[\n";
            $content .= $this->renderPhp($value, $level + 1, false);
        } else {
            $content .= "'$value'";
            $content .= ",\n";
        }
    }
    $content .= str_repeat(' ', 4 * ($level - 1))."]".($level === 1 ? ';' : ',')."\n";
    return $content;
}
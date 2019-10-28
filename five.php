<?php
function addText ($mass=[], $line){
    if(count($mass)<1){
        return false;
    } else {
        for ($i = 0; $i<count($mass);$i++)
        {
            $mass[$i].= $line;
        }
        return $mass;
    }
}

print_r(addText(['aaa','bb'],'qaaqqqasqq'));
<?php
foreach(glob("Functions/*.php") as $filename){
    include $filename;
}

foreach(glob("pageGen/*.php") as $filename){
    include $filename;
}

<?php
foreach(glob("Functions/*.php") as $filename){
    include $filename;
}

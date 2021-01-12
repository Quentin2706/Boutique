<?php
var_dump($_POST);
echo json_encode(Table_articleManager::getListApi($_POST["filtrage"]));
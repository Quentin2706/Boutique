<?php

echo json_encode(Table_articleManager::findByReferenceAPI($_POST["refPC"]));

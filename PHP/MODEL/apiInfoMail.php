<?php

echo json_encode(Table_clientManager::findByIdAPI($_POST["nomClient"]));
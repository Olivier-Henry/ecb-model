<?php

session_destroy();

//pour regénérer session et effacer ancien numéro du serveur
session_regenerate_id(true);
header("Location: http://chapitre.local");


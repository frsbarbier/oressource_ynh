<?php

/*
  Oressource
  Copyright (C) 2014-2017  Martin Vert and Oressource devellopers

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as
  published by the Free Software Foundation, either version 3 of the
  License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Changer ces valeurs selon votre configuration de systeme de base de donnée.
$host = 'localhost';
$port = 3306;
$base = '__DB_NAME__';
$user = '__DB_USER__';
$pass = '__DB_PWD__';

// Dans mysql le bon encodage pour l'utf-8 est utf8mb4.
// https://medium.com/@adamhooper/in-mysql-never-use-utf8-use-utf8mb4-11761243e434
$charset = 'utf8mb4';

// Configuration interne de Oressource
try {
  $bdd = new PDO("mysql:host=$host;port=$port;dbname=$base;charset=$charset", $user, $pass, [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_DIRECT_QUERY => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_STRINGIFY_FETCHES => false,
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
} catch (PDOException $e) {
  http_response_code(500); // Internal server error
  echo("<!DOCTYPE html>
  <html>
  <head>
  <meta encoding='utf8'/>
  </head>
  <body>
  <h1>500 Erreur interne de Oressource</h1>
  <p>Échec de la connection à la base de donnée, contactez votre administrateur il y à un soucis.<p>
  <p>Une fois le problème résolu vous pouvez recharger la page avec F5 ou la séquence Ctrl-alt-R.</p>
  </body>
  </html>");
  die('Error : Impossible de dialoguer avec la database. ' . $e->getMessage());
}
global $bdd;
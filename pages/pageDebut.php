<?php
require_once("../HTMLmaker.php");

echo HTMLmaker::getDebutHTML();
echo "<div class='panelDebut'>";
echo "<h2>Parametre de jeu</h2>";
echo "<h3>Quel joueur commence ?</h3>";
echo "<form method='GET' action='quantik.php'>";
echo "<p><input type='radio'  name='joueur' value='blanc' checked>";
echo "<label>Blanc</label></p>";
echo "<p><input type='radio'  name='joueur' value='noir'>";
echo "<label>Noir</label></p>";
echo "<p><input type='radio'  name='joueur' value='alea'>";
echo "<label>Aleatoire</label></p>";
echo "<input type='submit' class='button' value='Jouer'>";
echo "</from>";
echo "</div>";
echo HTMLmaker::getFinHTML();

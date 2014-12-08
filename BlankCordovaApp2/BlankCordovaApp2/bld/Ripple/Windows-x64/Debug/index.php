<?php
error_reporting(E_ALL);
$db = new PDO('mysql:host=neu-mysql;dbname=ivf;charset=utf8', 'ion-shop', 'molimed8212peha') or die('Fehler');

$language = 'DE';

if(isset($_POST['language']))
{
	$language = $_POST['language'];
}

$stmt = $db->query("SELECT              
                  prgr_beschreibung.gr_fk,
                  prgr_beschreibung.name,
                  prgr_bilder.dateiname,
                  prgr_beschreibung.beschreibung,
                  view_InternetKatalog.InternetKatalog
               FROM
                  artikel
               LEFT JOIN
                  view_InternetKatalog
               ON
                  view_InternetKatalog.ar_fk = artikel.pk
               LEFT JOIN
                  sg_pr
               ON
                  sg_pr.pr_fk = artikel.pr_fk
               LEFT JOIN
                  gr_sg
               ON
                  sg_pr.sg_fk = gr_sg.sg_fk                
               LEFT JOIN
                  prgr_beschreibung
               ON
                  gr_sg.gr_fk = prgr_beschreibung.gr_fk
               LEFT JOIN
                  prgr_bilder
               ON
                  prgr_beschreibung.gr_fk=prgr_bilder.prgr_fk
               where
                  prgr_beschreibung.sprache_iso='DE'
               AND
                  view_InternetKatalog.InternetKatalog>0
               GROUP BY
                  prgr_beschreibung.name
               ORDER BY
                  prgr_beschreibung.sortierung");
$productGroups = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
	$row['subGroups'] = getSubGroups($row['gr_fk']);
    $productGroups[] = $row;
}

echo json_encode(array("data" => $productGroups));


<?php
    require('model.php');
    $handle = fopen ("php://stdin","r");
    echo'Nom utilisateur du serveur mysql: ';
    $user = fgets($handle);
    echo'Mot de passe du serveur mysql: ';
    $pass = fgets($handle);
    $model = new ORM(trim($user),trim($pass));
    echo'Preciser le nom de la base de donnee: ';
    $dbname = fgets($handle);
    if(trim($dbname) !=""){
        $model->createDatabase(trim($dbname));
        echo "Base de donne creer avec succes... \n";
        echo'voulez vous creer une table(y/n): ';$choix=fgets($handle);
        do{
            echo'Entrer le nom de la table: ';$table=fgets($handle);
            if(trim($table)!=''){
                echo'Entrer le nom d\'un champ: ';$nom=fgets($handle);
                echo'Entrer son type: ';$type=fgets($handle);
                $model->createTable(trim($dbname),trim($table),trim($nom),trim($type));echo'La table cree... \n';
                echo'Ajouter d\'autres champs(y/n): ';$autre=fgets($handle);
                if(trim($autre)!='n'){
                   echo'Entrer le nombre de champs: ';$nchamp=fgets($handle);$i=0;
                    while($i<intval(trim($nchamp))){
                        echo'Entrer le nom d\'un champ: ';$nom=fgets($handle);
                        echo'Entrer son type: ';$type=fgets($handle);
                        $model->alterTableAdd(trim($dbname),trim($table),trim($nom),trim($type));echo'Champs ajoutez avec succes... \n';$i++;
                    }
                }
                echo'Ajouter cle etrangere ?(y/n)';$e=fgets($handle);
                if(trim($e)=='y'){
                    echo'Preciser nombre de cle etrangere: ';$nb=fgets($handle);$i=0;
                    while($i<intval(trim($nb))){
                        echo'nomme la cle etrangere';$nom=fgets($handle);
                        echo'Preciser le nom de la table avec sa cle primaire(ex: nomtable(id_cleprimaire)): ';$tableEtr=fgets($handle);
                        $model->alterTableForeign(trim($dbname),trim($table),trim($i),trim($nom),trim($tableEtr));$i++;
                    }
                }
                echo'Ajouter cle primaire (y/n)';$c=fgets($handle);
                if(trim($c)=='y'){
                    echo'1- Ajouter une cle primaire \n2-Ajouter plusieurs cle primaire';$ch=fgets($handle);
                    if(trim($ch)=='1'){
                        echo'Preciser la cle primaire: ';$cle=fgets($handle);
                        if(trim($cle)!=''){
                            $model->alterTablePrimary(trim($dbname),trim($table),trim($cle));
                        }
                    }else{
                        echo'Preciser les cles primaires(en separant avec des virgules): ';$cle=fgets($handle);
                        if(trim($cle)!=''){
                            $model->alterTablePrimarys(trim($dbname),trim($table),trim($cle));
                        }
                    }
                }
            }
            echo'voulez vous creer une nouvelle table(y/n): ';$choix=fgets($handle);
        }while($choix=='y');
    }
    echo "\n";
    echo "Thank you, continuing...\n";
?>


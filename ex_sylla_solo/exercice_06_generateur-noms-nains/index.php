<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Générateur de noms de nains</title>
    <style>
        body { font-family: AR JULIAN, Arial; }
    </style>
</head>
<body>
    <h1>Noms de nains</h1>

    <?php
    // Tableaux de syllabes
    $nain_debut = array('A', 'Ba', 'Bo', 'Bu', 'Bra', 'Bre', 'Bro', 'Da', 'Dra', 'Dro', 'Du', 'Ga', 'Go', 'Gu', 'Gra', 'Gri', 'Gro', 'I', 'Ka', 'Ko', 'Ku', 'O', 'U', 'Ta', 'Ti', 'To', 'Tu');
    $nain_liaison = array('ka', 'ko', 'la', 'lo', 'ra', 'rba', 'ro', 'rbo');
    $nain_fin = array('ban', 'dar', 'dir', 'dor', 'dur', 'gal', 'gan', 'gar', 'gor', 'grim', 'gur', 'kan', 'lan', 'lar', 'lek', 'li', 'lin', 'lion', 'lir', 'rak', 'ran', 'rek', 'rgrim', 'rgor', 'rik', 'ril', 'rion', 'rok', 'ron', 'tar', 'trek', 'tron');

   for ($i=0; $i < 20; $i++) {
        do {
            $nom[$i] = $nain_debut[array_rand($nain_debut)];
            if (rand(1, 10) <= 4) $nom = $nain_liaison[array_rand($nain_liaison)];
            $nom .= $nain_fin[array_rand($nain_fin)];
        } while (in_array($nom, $noms));  
        $noms[$i] = $nom;
    }
    
    sort($noms);

    // Faire une liste pour les nom générer en utilisant les ul 
    echo '<ul>';
    foreach ($noms as $k => $n) {
        echo '<li class="n',$k2,'">',$n;
    }
    echo '<ul>';
    ?>
</body>
</html>

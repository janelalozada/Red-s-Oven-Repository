 
<?php 
 
$result= $_POST['search'];
$result= strtolower($result);

if ($result=="heart")
header ('Location: heart.php');

elseif ($result=="classic")
header ('Location: circle.php');

elseif ($result=="bento")
header ('Location: bento.php');

elseif ($result=="special")
header ('Location: special.php');

elseif ($result=="bundle")
header ('Location: bundle.php');

elseif ($result=="double")
header ('Location: bundle.php');

elseif ($result=="blossom duo")
header ('Location: bundle.php');

elseif ($result=="blooming love bundle")
header ('Location: bundle.php');

elseif ($result=="Heartfelt Blossom")
header ('Location: bundle.php');

elseif ($result=="Love in Bloom")
header ('Location: bundle.php');

elseif ($result=="Flower Garden Bundle")
header ('Location: bundle.php');

elseif ($result=="floral fantasy")
header ('Location: special.php');

elseif ($result=="Wings of Blue")
header ('Location: special.php');

elseif ($result=="Royal Pink Bliss")
header ('Location: special.php');

elseif ($result=="Kuromi’s Sugar Rush")
header ('Location: special.php');

elseif ($result=="Roar of Sweetness")
header ('Location: special.php');

elseif ($result=="Soft Glow Cake")
header ('Location: bento.php');

elseif ($result=="Barbie Dream Cake")
header ('Location: bento.php');

elseif ($result=="Pinky Swirl")
header ('Location: bento.php');

elseif ($result=="Tiny Tiers")
header ('Location: bento.php');

elseif ($result=="Sweet Peony")
header ('Location: bento.php');

elseif ($result=="Dainty Delight")
header ('Location: bento.php');

elseif ($result=="Minty Whispers")
header ('Location: classic.php');

elseif ($result=="Infinity Round")
header ('Location: classic.php');

elseif ($result=="Orb of Joy")
header ('Location: classic.php');

elseif ($result=="Green Serenity")
header ('Location: classic.php');

elseif ($result=="Sweet Sphere")
header ('Location: classic.php');

elseif ($result=="Classic Charm Cake")
header ('Location: classic.php');

elseif ($result=="Berry Bliss")
header ('Location: classic.php');

else{
 header ('Location: else.php');
}


?> 
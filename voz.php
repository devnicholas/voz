<?php
$texto = @$_GET['q'];
if($texto){
header ("Content-type: octet/stream");
header ("Content-disposition: attachment; filename=audio-".$_GET['name'].".mp3;");
// Usamos la API de ResponsiveVoice para generar el audio
$audio = file_get_contents('http://responsivevoice.org/responsivevoice/getvoice.php?t=' . urlencode($texto) . '&tl=pt-BR');
echo $audio;
file_put_contents('/var/www/vestseller.com.br/app-bot/audio/audio-'.$_GET['name'].'.mp3',$audio);
exit;
}else{
?>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
Texto: <input id="texto" value="Oi, eu sou a Sonya!" /><br>
<button type="button" id="play">Play</button>
<a download id="download" target="_blank">Baixar</a>

<script>
var texto = document.getElementById('texto');
var play = document.getElementById('play');
var download = document.getElementById('download');

play.onclick = function() {
  responsiveVoice.speak(texto.value, 'Brazilian Portuguese Female');
}
texto.onblur = function () {
  var url = 'https://www.vestseller.com.br/app-bot/voz.php?q=' + 
      encodeURIComponent(texto.value)+'&name=<?= time(); ?>';

  download.href = url;
}
texto.onblur();
</script>
<?php } ?>

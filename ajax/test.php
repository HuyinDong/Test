<?php

$t = "½ðÉ½´Ê°Ô±¾µØ»º³åÇøÒç³öÂ©¶´";
echo iconv('GB 2312-80', 'UTF-8', $t);
echo mb_convert_encoding($t, 'UTF-8', 'GB 2312-80');

mb_internal_encoding('UTF-8');
echo mb_decode_mimeheader("=?GB2312?b?xOO6wsa==?=");

 ?>

<?php
function convertirFechaIsoAFormatoBD($fechaIso) {
    $fechaPhp = DateTime::createFromFormat('Y-m-d\TH:i', $fechaIso);
    return $fechaPhp->format('Y-m-d H:i:s');
}
?>
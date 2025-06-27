<?php
class ActionsDolisplitpay
{
    public function formObjectOptions($parameters, &$object, &$action, $hookmanager)
    {
        global $langs;
        $langs->load("dolisplitpay@dolisplitpay");

        if (is_object($object) && get_class($object) == 'Facture') {
            if ($object->statut == 1) { // Facture valid\u00e9e uniquement
                $url = dol_buildpath('/custom/doli-splitpay/convert.php?id=' . $object->id, 1);
                print '<div class="inline-block divButAction">';
                print '<a class="butAction" href="' . $url . '">';
                print $langs->trans("ConvertToSplitpay");
                print '</a>';
                print '</div>';
            } else if ($object->statut == 0) {
                print '<div class="opacitymedium">'.$langs->trans("SplitpayRequireValidation").'</div>';
            }
        }

        return 0;
    }
}

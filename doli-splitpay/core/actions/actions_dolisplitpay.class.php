<?php

class ActionsDolisplitpay
{
    /**
     * Hook to add a button in the invoice card
     */
    function addMoreActionsButtons($parameters, &$object, &$action, $hookmanager)
    {
        global $langs, $conf, $user;

        $langs->load("bills");
        $langs->load("dolisplitpay@dolisplitpay");

        $result = 0;

        if (get_class($object) == 'Facture' && $object->statut == 1) { // Facture validée
            print '<div class="inline-block divButAction">';
            $url = dol_buildpath('/custom/doli-splitpay/convert.php?id=' . $object->id, 1);
            print '<a class="butAction" href="' . $url . '">';
            print $langs->trans("ConvertToSplitpay");
            print '</a>';
            print '</div>';
        }

        return $result;
    }
}

<?php
require '../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/compta/facture/class/facture.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

$langs->load("bills");
$langs->load("dolisplitpay@dolisplitpay");

$id = GETPOST('id', 'int');
$action = GETPOST('action', 'alpha');

if (empty($id)) accessforbidden();

$invoice = new Facture($db);
if ($invoice->fetch($id) <= 0) {
    print $langs->trans("ErrorInvoiceNotFound");
    llxFooter();
    exit;
}

llxHeader("", $langs->trans("ConvertToSplitpay"));

print '<h1>'.$langs->trans("ConvertToSplitpay").'</h1>';
print '<p>'.$langs->trans("InvoiceRef").' : <strong>'.$invoice->ref.'</strong></p>';
print '<p>'.$langs->trans("TotalTTC").' : <strong>'.price($invoice->total_ttc).' '.$langs->trans("Currency".$conf->currency).'</strong></p>';

print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?id='.$id.'">';
print '<input type="hidden" name="action" value="generate_schedule">';
print '<table class="border" width="50%">';
print '<tr><td>'.$langs->trans("NumberOfInstallments").'</td>';
print '<td><input type="number" name="nb_months" value="3" min="1" required></td></tr>';
print '<tr><td>'.$langs->trans("StartDate").'</td>';
print '<td><input type="date" name="start_date" value="'.dol_print_date(dol_now(), 'dayinput').'"></td></tr>';
print '</table><br>';
print '<div class="center">';
print '<input type="submit" class="button" value="'.$langs->trans("GenerateSchedule").'">';
print '</div>';
print '</form>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action == 'generate_schedule') {
    $nb_months = (int) GETPOST('nb_months', 'int');
    $start_date = dol_stringtotime(GETPOST('start_date', 'alpha'));

    if ($nb_months > 0 && $start_date > 0) {
        $total = $invoice->total_ttc;
        $montant_mensuel = round($total / $nb_months, 2);
        $reste = $total - ($montant_mensuel * $nb_months);

        print '<h3>'.$langs->trans("SchedulePreview").'</h3>';
        print '<table class="noborder" width="60%">';
        print '<tr class="liste_titre">';
        print '<td>'.$langs->trans("InstallmentNum").'</td>';
        print '<td>'.$langs->trans("DueDate").'</td>';
        print '<td>'.$langs->trans("Amount").'</td>';
        print '</tr>';

        for ($i = 0; $i < $nb_months; $i++) {
            $date_echeance = dol_time_plus_duree($start_date, $i, 'm');
            $montant = $montant_mensuel;
            if ($i == $nb_months - 1) {
                $montant += $reste;
            }
            print '<tr><td>'.($i + 1).'</td>';
            print '<td>'.dol_print_date($date_echeance, 'day').'</td>';
            print '<td>'.price($montant).' '.$langs->trans("Currency".$conf->currency).'</td></tr>';
        }

        print '</table><br>';
    } else {
        print '<div class="error">'.$langs->trans("MissingFields").'</div>';
    }
}

llxFooter();
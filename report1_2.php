<?php

require 'pdf.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$random = new Random();

if ($user->isLoggedIn()) {
    try {
        // switch (Input::get('report')) {
        //     case 1:
        //         $data = $override->searchBtnDate3('batch', 'create_on', $_GET['start'], 'create_on', $_GET['end'], 'use_group', $_GET['group']);
        //         $data_count = $override->getCountReport('batch', 'create_on', $_GET['start'], 'create_on', $_GET['end'], 'use_group', $_GET['group']);
        //         break;
        //     case 2:
        //         $data = $override->searchBtnDate3('check_records', 'create_on', $_GET['start'], 'create_on', $_GET['end'], 'use_group', $_GET['group']);
        //         $data_count = $override->getCountReport('check_records', 'create_on', $_GET['start'], 'create_on', $_GET['end'], 'use_group', $_GET['group']);
        //         break;
        //     case 3:
        //         $data = $override->searchBtnDate3('batch_records', 'create_on', $_GET['start'], 'create_on', $_GET['end'], 'use_group', $_GET['group']);
        //         $data_count = $override->getCountReport('batch_records', 'create_on', $_GET['start'], 'create_on', $_GET['end'], 'use_group', $_GET['group']);
        //         break;
        // }

        $site_data = $override->getData('site');
        $Total = $override->getCount('clients', 'status', 1);
        $data_enrolled = $override->getCount1('clients', 'status', 1, 'enrolled', 1);
        // $name = $override->get('user', 'status', 1, 'screened', $user->data()->id);
        // $data_count = $override->getCount2('clients', 'status', 1, 'screened',1, 'site_id', $ussite_dataer->data()->site_id);

        $successMessage = 'Report Successful Created';
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    Redirect::to('index.php');
}

// if ($_GET['group'] == 1) {
//     $title = 'Medicines';
// } elseif ($_GET['group'] == 2) {
//     $title = 'Medical Equipments';
// } elseif ($_GET['group'] == 3) {
//     $title = 'Accessories';
// } elseif ($_GET['group'] == 4) {
//     $title = 'Supplies';
// }



$title = 'PENPLUS SUMMARY REPORT_' . date('Y-m-d');

$pdf = new Pdf();

// $title = 'NIMREGENIN SUMMARY REPORT_'. date('Y-m-d');
$file_name = $title . '.pdf';

$output = ' ';

// if ($_GET['group'] == 2) {
if ($site_data) {

    $output .= '
            <table width="100%" border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <td colspan="17" align="center" style="font-size: 18px">
                        <b>DATE  ' . date('Y-m-d') . '</b>
                    </td>
                </tr>


                <tr>
                    <td colspan="17" align="center" style="font-size: 18px">
                        <b>TABLE 3 </b>
                    </td>
                </tr>

                <tr>
                    <td colspan="17" align="center" style="font-size: 18px">
                        <b>' . $title . '</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="17" align="center" style="font-size: 18px">
                        <b>Total Registered ( ' . $Total . ' ):  Total Enrolled( ' . $data_enrolled . ' )</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="17">                        
                        <br />
                        <table width="100%" border="1" cellpadding="5" cellspacing="0">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">SITE</th>
                                <th rowspan="2">REGISTERED</th>
                                <th rowspan="2">SCREENED.</th>
                                <th rowspan="2">ELIGIBLE</th>
                                <th colspan="5"> Category ( INCLUSION )</th>
                                <th rowspan="2">ENROLLED</th>
                                <th rowspan="2">END</th>
                            </tr>
                            <tr>
                                <th>Cardiac</th>
                                <th>Diabetes(Type 1)</th>
                                <th>Diabetes(Type 2)</th>
                                <th>Sickle cell </th>
                                <th>Sickle cell( Other ) </th>
                            </tr>
            ';

    // Load HTML content into dompdf
    $x = 1;
    foreach ($site_data as $row) {
        $registered = $override->countData('clients', 'status', 1, 'site_id', $row['id']);
        $registered_Total = $override->getCount('clients', 'status', 1);
        $screened = $override->countData2('clients', 'status', 1, 'screened', 1, 'site_id', $row['id']);
        $screened_Total = $override->countData('clients', 'status', 1, 'screened', 1);
        $sickle_cell1 = $override->countData2('sickle_cell', 'status', 1, 'diagnosis', 1, 'site_id', $row['id']);
        $sickle_cell_Total1 = $override->countData('sickle_cell', 'status', 1, 'diagnosis', 1);
        $sickle_cell2 = $override->countData2('sickle_cell', 'status', 1, 'diagnosis', 96, 'site_id', $row['id']);
        $sickle_cell_Total2 = $override->countData('sickle_cell', 'status', 1, 'diagnosis', 96);
        $sickle_cell = $override->countData2('clients', 'status', 1, 'sickle_cell', 1, 'site_id', $row['id']);
        $sickle_cell_Total = $override->countData('clients', 'status', 1, 'sickle_cell', 1);
        // $cardiac1 = $override->countData2('cardiac', 'status', 1, 'cardiac', 1, 'site_id', $row['id']);
        // $cardiac_Total1 = $override->countData('cardiac', 'status', 1, 'cardiac', 1);
        // $cardiac2 = $override->countData2('cardiac', 'status', 1, 'cardiac', 1, 'site_id', $row['id']);
        // $cardiac_Total2 = $override->countData('cardiac', 'status', 1, 'cardiac', 1);
        $cardiac = $override->countData2('clients', 'status', 1, 'cardiac', 1, 'site_id', $row['id']);
        $cardiac_Total = $override->countData('clients', 'status', 1, 'cardiac', 1);
        $diabetes1 = $override->countData2('diabetic', 'status', 1, 'diagnosis', 1, 'site_id', $row['id']);
        $diabetes_Total1 = $override->countData('diabetic', 'status', 1, 'diagnosis', 1);
        $diabetes2 = $override->countData2('diabetic', 'status', 1, 'diagnosis', 2, 'site_id', $row['id']);
        $diabetes_Total2 = $override->countData('diabetic', 'status', 1, 'diagnosis', 2);
        $diabetes = $override->countData2('clients', 'status', 1, 'diabetes', 1, 'site_id', $row['id']);
        $diabetes_Total = $override->countData('clients', 'status', 1, 'diabetes', 1);
        $eligible = $override->countData2('clients', 'status', 1, 'eligible', 1, 'site_id', $row['id']);
        $eligible_Total = $override->countData('clients', 'status', 1, 'eligible', 1);
        $enrolled = $override->countData2('clients', 'status', 1, 'enrolled', 1, 'site_id', $row['id']);
        $enrolled_Total = $override->countData('clients', 'status', 1, 'enrolled', 1);
        $end_study = $override->countData2('clients', 'status', 1, 'end_study', 1, 'site_id', $row['id']);
        $end_study_Total = $override->countData('clients', 'status', 1, 'end_study', 1);

        $output .= '
                <tr>
                    <td>' . $x . '</td>
                    <td>' . $row['name']  . '</td>
                    <td align="right">' . $registered . '</td>
                    <td align="right">' . $screened . '</td>
                    <td align="right">' . $eligible . '</td>
                    <td align="right">' . $cardiac . '</td>
                    <td align="right">' . $diabetes1 . '</td>
                     <td align="right">' . $diabetes2 . '</td>
                    <td align="right">' . $sickle_cell1 . '</td>
                    <td align="right">' . $sickle_cell2 . '</td>
                    <td align="right">' . $enrolled . '</td>
                    <td align="right">' . $end_study . '</td>
                </tr>
            ';

        $x += 1;
    }

    $output .= '
                <tr>
                    <td align="right" colspan="2"><b>Total</b></td>
                    <td align="right"><b>' . $registered_Total . '</b></td>
                    <td align="right"><b>' . $screened_Total . '</b></td>
                    <td align="right"><b>' . $eligible_Total . '</b></td>
                    <td align="right"><b>' . $cardiac_Total . '</b></td>
                    <td align="right"><b>' . $diabetes_Total1 . '</b></td>
                    <td align="right"><b>' . $diabetes_Total2 . '</b></td>
                    <td align="right"><b>' . $sickle_cell_Total1 . '</b></td>
                    <td align="right"><b>' . $sickle_cell_Total2 . '</b></td>
                    <td align="right"><b>' . $enrolled_Total . '</b></td>
                    <td align="right"><b>' . $end_study_Total . '</b></td>
                </tr>  

    '
    ;

    $output .= '
            </table>    
                <tr>
                    <td colspan="8" align="center" style="font-size: 18px">
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <p align="right">----'.$user->data()->firstname. ' '.$user->data()->lastname.'-----<br />Prepared By</p>
                        <br />
                        <br />
                        <br />
                    </td>

                    <td colspan="9" align="center" style="font-size: 18px">
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <p align="right">-----'.date('Y-m-d').'-------<br />Date Prepared</p>
                        <br />
                        <br />
                        <br />
                    </td>
                </tr>
        </table>    
';
}

// $output = '<html><body><h1>Hello, dompdf!' . $row . '</h1></body></html>';
$pdf->loadHtml($output);

// SetPaper the HTML as PDF
// $pdf->setPaper('A4', 'portrait');
$pdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$pdf->render();

// Output the generated PDF
$pdf->stream($file_name, array("Attachment" => false));

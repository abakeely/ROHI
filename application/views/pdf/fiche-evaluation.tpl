<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
</head>
<body>
<font face="Arial, sans-serif">
    <p style="text-align: center;">
        <img src="{$utils::base_64_image('/application/modules/evaluations/assets/images/logo-mef-1.png')}" alt="">
    </p>
    <table width="100%">
        <tr>
            <td width="50%" align="center">
               <strong>
             <!--   SECRETARIAT GENERAL <br/-->
                {*$data.path.direction[0].libele}<br/>
                   {$data.path.service[0].libele}<br/>
                   {if $data.agent->structure_rang == 'DIV'}
                        {$data.agent->structure_sigle}<br/>
                   {/if*}
                   {'<br/>'|implode:$data.path.path}
               </strong>
            </td>
            <td width="50%" align="center">
                <strong>
                <u>FICHE D’EVALUATION</u> <br/>
                    {$data.agent->periode_evaluation} {$data.agent->year_evaluation}
                </strong>
            </td>
        </tr>
    </table>
    <hr>
    <br/>
    <table width="85%" style="margin: 0 auto;">
        <tr>
            <td>
                <strong>
                    <u>Identité de l’agent évalué :</u>
                </strong>
                <table width="100%">
                    <tr>
                        <td width="20%" align="center">
                            {assign var="file_user_photo" value=PATH_ROOT_DIR|cat:'/upload/'|cat:$data.agent->id_agent|cat:'.'|cat:$data.agent->type_photo}
                            {if file_exists($file_user_photo)}
                                {assign var="user_photo" value=$utils::base_64_image('/upload/'|cat:$data.agent->id_agent|cat:'.'|cat:$data.agent->type_photo)}
                            {else}
                                {assign var="user_photo" value=$utils::base_64_image('/application/modules/evaluations/assets/images/user.png')}
                            {/if}
                            <img src="{$user_photo}" width="75" height="75" alt="">
                        </td>
                        <td width="40%" align="left">
                            {$data.agent->nom|upper} {$data.agent->prenom|ucfirst} <br/>
                            {$data.agent->matricule}<br/>
                            {$data.agent->fonction_actuel}<br/>
                        </td>
                        <td width="40%" align="left">
                            Téléphone: {$data.agent->phone}<br/>
                            Lieu de service: {if $data.agent->porte !== null}Porte {$data.agent->porte}{/if} {$data.agent->localite_service}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="85%" style="margin: 0 auto;">
        <tr>
            <td>
                <p>
                    <strong><u>Identité de l’Evaluateur :</u></strong> {$data.evaluateur->nom|upper} {$data.evaluateur->prenom}, IM : {$data.evaluateur->matricule} <br/>
                    <strong><u>Date de l’Evaluation :</u></strong> {$data.agent->date|date_format:"%d"} {$utils::fr_month($data.agent->date)} {$data.agent->date|date_format:"%Y"}
                </p>
                <br/>
                <strong><u>Appréciation de l’agent pour la période concernée :</u></strong>



            </td>
        </tr>
    </table>
    <table width="85%" style="margin: 0 auto;">
    {foreach from=$data.questions item=q}
                        <tr>
                            <td width="80%">{$q->question}</td>
                            <td width="20%">{$q->appreciation}</td>
                        </tr>
                    {/foreach}
    </table>

<div style="page-break-after: always;"></div>
    <table width="85%" style="margin: 0 auto;">
        <tr>
            <td>
                <br/>
                <strong><u>Appréciation de l’agent Par Elément de notation :</u></strong><br/>
                {foreach from=$data.elements item=element}
                    <strong><u>{$element.name}:</u></strong> {$element.appreciation} <br/>
                {/foreach}

                <br/>
                <strong><u>Appréciation générale de l’Agent :</u> {$data.agent->appreciation} Agent</strong><br/>
                {$data.agent->appreciation_generale}
                <br/><br/>
            </td>
        </tr>
    </table>
    <br/>
    <table width="85%">
        <tr>
            <td width="50%">

            </td>

            <td width="50%" align="center" style="border: 1px solid #000;">
                <strong><u>Signature et timbre de l’Evaluateur</u></strong>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
            </td>
        </tr>

    </table>


</font>
</body>
</html>
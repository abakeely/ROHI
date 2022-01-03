<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<font face="Arial, sans-serif">
    <table width="100%">
        <tr>
            <td width="50%">
                <div style="text-align:center;">
                    <p>
                        REPOBLIKAN’I MADAGASIKARA <br/>
                        <small>Fitiavana - Tanindrazana – Fandrosoana</small>
                    </p>

                    <p>
                        -----------<br/>
                        <strong>PERSONNEL DES CADRES DE L’ETAT</strong><br/>
                        -----------
                    </p>
                    <p>
                        MINISTERE DE L’ECONOMIE <br/>
                        <span style="display:inline-block;width:60%;border-top:2px solid #000;border-bottom:2px solid #000;">ET DES FINANCES</span>
                    </p>

                </div>

            </td>
            <td width="50%">
                <div style="text-align:center;">
                    <p>Article 3 du décret n°68-48 <br/>
                        <span style="border-bottom:1px solid #000;">
                                    Du 23 octobre 1968
                                  </span>
                    </p>
                    <p><strong>ANNEE: {$data.bin_year}</strong> </p>
                </div>
            </td>
        </tr>
    </table>
    <h2 style="text-align:center;">BULLETIN INDIVIDUEL DE NOTES</h2>
    <br/>
    <h3 style="text-align:center;">ETAT CIVIL</h3>
    <div style="padding:35px;">
        <p>
            <b>Nom et prénom :</b> {$data.agent->nom|upper}  {$data.agent->prenom|ucfirst} <b>IM:</b> {$data.agent->matricule} <br/>
            <b>Date et lieu de naissance :</b> {$data.agent->date_naiss|date_format:"%d / %m / %Y"} <b>à:</b> xxxxxxxxx <br/>
            <b>Célibataire, marié veuf ou divorcé :</b> {$data.agent->situation_matr} <br/>
            <b>Nombre d’enfants vivants :</b> {$data.agent->nbr_enfant} <b>Nombre d’enfants à charge :</b> {$data.agent->nbr_enfant}<br/>
        </p>
    </div>

    <br/>
    <h3 style="text-align:center;">SITUATION ADMINISTRATIVE</h3>
    <div style="padding:35px;">
        <p>
            <b>Grade actuel :</b> {$data.agent->grade} <b>Pour compter du :</b> 0000000000000000000 <br/>
            <b>Fonction et résidence actuelles :</b> {$data.agent->poste|upper}
        </p>
    </div>
    <br/>
    <h3 style="text-align:center;">RENSEIGNEMENTS</h3>
    <div style="padding:35px;">
        <p>
            <b>Titres universitaires et diplômes : Distinction honorifiques :</b>
                <ul>
                    {foreach from=$data.agent_diplome item=diplome}
                        <li>
                            {$diplome->diplome_date} : {$diplome->diplome_name|upper}
                            {if $diplome->diplome_name == 'bacc'}serie{else}en{/if} {$diplome->diplome_disc|ucfirst} {$diplome->diplome_etab} {$diplome->diplome_pays|upper}
                        </li>
                    {/foreach}
                </ul>
            <br/>
            <b>Aptitudes spéciales :</b> xxxxxxxxxxxxxxxxxxxxxxxxx <br/>
            <b>Adresse de la personne à prévenir en cas d’accident :</b> xxxxxxxxxxxxxxxxxxxxx
        </p>
    </div>
    <br/>
    <h3 style="text-align:center;">NOTES ET APPRECIATIONS</h3>
    {foreach from=$data.evaluations key=k item=evaluation}
        {if $k == 0}
    <table width="100%">
        <tr>
            <td width="50%" align="center">
                <p>
                    <b>Note du:</b>{$evaluation->date|date_format:"%d-%m-%Y"}
                    <br/>
                    <b>Appréciation générale : {$evaluation->appreciation_generale}</b>
                </p>

                <table>
                    <tr>
                        <td>19 à 20</td>
                        <td>Exceptionnel</td>
                    </tr>
                    <tr>
                        <td>17 à 19</td>
                        <td>Excellent</td>
                    </tr>
                    <tr>
                        <td>15 à 17</td>
                        <td>Très bon</td>
                    </tr>
                    <tr>
                        <td>13 à 15</td>
                        <td>Bon</td>
                    </tr>
                    <tr>
                        <td>11 à 13</td>
                        <td>Assez bon</td>
                    </tr>
                    <tr>
                        <td>08 à 11</td>
                        <td>Passable</td>
                    </tr>
                    <tr>
                        <td>04 à 08</td>
                        <td>Médiocre</td>
                    </tr>
                    <tr>
                        <td>Au-dessous de 04</td>
                        <td>Mauvais</td>
                    </tr>
                </table>
            </td>
            <td width="50%" align="center">
                {if $evaluation->id_groupe == 1}
                <h4>Fonctionnaires des catégories : A et B</h4>
                    {else}
                     <h4>Fonctionnaires des catégories : C et D</h4>
                    {/if}
                <table>
                    {assign var='notes' value=0}
                    {foreach from=$evaluation->elements_notations item=element}
                    <tr>
                        <td>{$element[0]->name}:</td>
                        {if $element[0]->moyenne == 0}
                            {assign var='moyenne_1' value=($element[0]->min + $element[0]->max)/2}
                        {else}
                            {assign var='moyenne_1' value=$element[0]->moyenne}
                        {/if}
						{if $element[1]->moyenne == 0}
                            {assign var='moyenne_2' value=($element[1]->min + $element[1]->max)/2}
                        {else}
                            {assign var='moyenne_2' value=$element[1]->moyenne}
                        {/if}
                        
                        <td>{($moyenne_1 + $moyenne_2)/2}/20</td>
                    </tr>
                        {$notes = $notes +(($moyenne_1 + $moyenne_2)/2)}
                        {*math equation='x+1' x=($moyenne_1 + $moyenne_2)/2 assign="notes"*}
                    {/foreach}
                   
                    <tr>
                        <td></td>
                        <td>{$notes}/4 Cote/20</td>
                    </tr>
                    <tr>
                        <td><b></b></td>
                        <td><b>{($notes/4)|number_format:2:".":","}/20</b></td>
                    </tr>
                </table>
				<p>
                        A _______________________ le________________ <br/>Le____________________________
                    </p>
            </td>
        </tr>
    </table>
            <div style="text-align:center;">
                <table width="90%" style="margin: 0 auto;">
                    <tr>
                        <td width="50%" align="left">
                            <p>
                                Note du <span style="border-bottom:1px solid #000;">{$evaluation->date|date_format:"%d-%m-%Y"}</span>
                            </p>
                            <p>
                                Appréciation générale : <span style="border-bottom:1px solid #000;">{$evaluation->appreciation_generale}</span>
                            </p>
                            <p>
                                Proposition : <span style="border-bottom:1px solid #000;">{$evaluation->appreciation}</span>
                            </p>
                            <p>
                                COTE {$evaluation->moyenne}/20
                            </p>
                        </td>
                        <td width="50%" align="left">
                            <p>
                                A _______________________ le________________ <br/>Le____________________________
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
    {/if}
    {if $k > 0}
    <br/>
    <div style="text-align:center;">
        <table width="90%" style="margin: 0 auto;">
            <tr>
                <td width="50%" align="left">
                    <p>
                        Note du <span style="border-bottom:1px solid #000;">{$evaluation->date|date_format:"%d-%m-%Y"}</span>
                    </p>
                    <p>
                        Appréciation générale : <span style="border-bottom:1px solid #000;">{$evaluation->appreciation_generale}</span>
                    </p>
                    <p>
                        Proposition : <span style="border-bottom:1px solid #000;">{$evaluation->appreciation}</span>
                    </p>
                    <p>
                        COTE {$evaluation->moyenne}/20
                    </p>
                </td>
                <td width="50%" align="left">
                    <p>
                        A _______________________ le________________ <br/>Le____________________________
                    </p>
                </td>
            </tr>
        </table>
    </div>
     {/if}
{/foreach}
</font>
</body>
</html>
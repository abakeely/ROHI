
{foreach from=$toTete item=oTete}
<marquee SCROLLAMOUNT="3">
	<font size="2">
		<font face="Arial">
			<font color=" red " face="Times New Roman"><b>RESTITUTION:</b></font>
				<font color="elo " face="Times New Roman">&nbsp; {$oTete.date_restitution|date_format:"%d/%m/%Y"}  <font color="white"> &nbsp; à &nbsp;</font> {$oTete.heure_restitution} - {$oTete.lieu_restitution1}</font>
					<font color="black" face="Times New Roman"><font color="white">&nbsp; Thème: </font> &laquo; {$oTete.intitule_restitution} &raquo;</font>
						<font color="white" face="Times New Roman">présenté par</font>
						<font color="black" face="Times New Roman">{$oTete.nom_prenom_restitution}	</font>				
		</font>
		</font>
	</marquee> 
	
{/foreach}

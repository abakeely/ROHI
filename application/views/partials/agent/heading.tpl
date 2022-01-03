<div class="info-heading">
    <div class="row">
        <div class="col-sm-6">
            <div class="info-perso row">
                <div class="col-sm-3">
                    <div class="photo-agent">
                        <img width="75" height="75" src="{base_url('/upload')}/{$candidat->id}.jpg" alt="" class="rounded-circle">
                    </div>
                </div>
                <div class="col-sm-9">
                    <strong>{$candidat->nom|upper} {$candidat->prenom}</strong>
                    <br> {$candidat->matricule}
                    <br> {$candidat->poste}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            Téléphone: {$candidat->phone}
            <br>Lieu de service: Porte {$candidat->porte}, X étage, {$candidat->localite_service}
        </div>
    </div>
</div>